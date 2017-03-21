<?php

if (!defined('ABSPATH')) exit;

class gdrts_core_query {
    public $args = array();
    public $votes = false;

    public $sql = '';

    public function __construct() { }

    public function run($args = array()) {
        $defaults = array(
            'method' => 'stars-rating',
            'series' => '',
            'entity' => 'posts',
            'name' => 'post',
            'id__in' => array(),
            'id__not_in' => array(),
            'orderby' => 'rating',
            'order' => 'DESC',
            'offset' => 0,
            'limit' => 5,
            'return' => 'objects', // ids, objects, quick,
            'rating_min' => 0,
            'votes_min' => 1,
            'period' => false,
            'source' => '',
            'object' => array(
                'status' => array('publish', 'closed'),
                'author' => array(),
                'meta' => array(),
                'terms' => array()
            )
        );

        $this->args = wp_parse_args($args, $defaults);

        $this->votes = apply_filters('gdrts_query_has_votes_'.$this->args['method'], $this->votes);

        if (!$this->votes && in_array($this->args['orderby'], array('votes', 'sum'))) {
            $this->args['orderby'] = 'rating';
        }

        $query = $this->build_query();

        $items = gdrts_db()->run_and_index($query, 'item_id');

        switch ($this->args['return']) {
            case 'ids':
                return array_keys($items);
            case 'quick':
                return array_values($items);
            default:
            case 'objects':
                return $this->prepare_objects($items);
        }
    }

    public function parse_order() {
        $q = array(
            'select' => '',
            'from' => '',
            'where' => array(),
            'order' => ''
        );

        if ($this->args['orderby'] != '' && $this->args['orderby'] != 'none') {
            if ($this->args['orderby'] == 'rand') {
                $q['order'] = ' ORDER BY RAND()';
            } else {
                $q['order'] = ' ORDER BY ';

                $order = 'DESC';
                $orderby = $this->args['orderby'];

                if (strtoupper($this->args['order']) == 'ASC') {
                    $order = 'ASC';
                }

                $_default = 'rating ';
                if ($this->votes) {
                    $_default.= $order.', votes';
                }
                
                switch ($orderby) {
                    case 'item':
                    case 'item_id':
                        $q['order'].= 'i.`item_id`';
                        break;
                    case 'id':
                        $q['order'].= 'i.`id`';
                        break;
                    case 'latest':
                        $q['order'].= 'i.`latest`';
                        break;
                    case 'votes':
                        $q['order'].= 'votes';
                        break;
                    case 'sum':
                        $q['select'] = ", ms.`meta_value` as sum";
                        $q['from'] = " INNER JOIN ".gdrts_db()->itemmeta." ms ON ms.`item_id` = i.`item_id` AND ms.`meta_key` = '".$this->_method()."_sum'";
                        $q['order'].= 'sum';
                        break;
                    case 'rating':
                        $q['order'].= $_default;
                        break;
                    default:
                        $q['order'].= apply_filters('gdrts_core_query_sort_orderby_'.$orderby, $_default, $this->args);
                        break;
                }

                $q['order'].= ' '.$order;
            }
        }

        return $q;
    }

    public function parse_period() {
        return array('where' => array());
    }

    public function parse_object() {
        $q = array(
            'select' => '', 'from' => '', 'where' => array()
        );

        $d = wp_parse_args($this->args['object'], array('author' => array(), 'meta' => array(), 'terms' => array()));

        $active = false;

        foreach ($d as $key => &$value) {
            $value = (array)$value;

            if (!empty($value)) {
                $active = true;
            }
        }

        if ($active) {
            switch ($this->args['entity']) {
                case 'posts':
                    $q = $this->_parse_object_posts($d);
                    break;
                case 'comments':
                    $q = $this->_parse_object_comments($d);
                    break;
                case 'terms':
                    $q = $this->_parse_object_terms($d);
                    break;
                case 'users':
                    $q = $this->_parse_object_users($d);
                    break;
            }
        }

        return $q;
    }

    public function build_query() {
        $parts = $this->prepare_query_parts();

        $this->sql = "SELECT DISTINCT ".$parts['select']." FROM ".$parts['from'];

        if (!empty($parts['where'])) {
            $this->sql.= " WHERE ".join(' AND ', $parts['where']);
        }

        $this->sql.= $parts['group'].$parts['order'].$parts['limit'];

        $this->sql = apply_filters('gdrts_core_query_sql', $this->sql, $parts, $this->args);

        return $this->sql;
    }

    public function prepare_objects($items) {
        $list = array();

        $get = array();
        foreach ($items as $item_id => $obj) {
            gdrts()->cache()->set('item_id', $obj->entity.'-'.$obj->name.'-'.$obj->id, $item_id);

            if (!gdrts()->cache()->in('item', $item_id)) {
                $get[] = $item_id;
            }
        }

        if (!empty($get)) {
            $metas = gdrts_db()->get_items_meta($get);
        }

        $i = 1;
        foreach ($items as $item_id => $obj) {
            $data = (array)$obj;
            $data['meta'] = isset($metas[$item_id]) ? $metas[$item_id] : array();

            gdrts()->cache()->add('item', $item_id, $data);

            $item = gdrts_get_rating_item_by_id($item_id);
            $item->ordinal = $i;
            $list[] = $item;

            $i++;
        }

        return $list;
    }

    public function prepare_query_parts() {
        $parts = array(
            'select' => '',
            'from' => '',
            'where' => array(
                "i.`entity` = '".$this->args['entity']."'",
                "i.`name` = '".$this->args['name']."'"
            ),
            'group' => '',
            'order' => '',
            'limit' => ''
        );

        $parts['select'] = $this->args['return'] == 'ids' ? 'i.`item_id`' : 'i.*';
        $parts['select'].= ", CAST(m.`meta_value` AS DECIMAL(10,2)) as rating";

        $parts['from'] = gdrts_db()->items." i INNER JOIN ".gdrts_db()->itemmeta." m";
        $parts['from'].= " ON m.item_id = i.item_id AND m.meta_key = '".$this->_method()."_rating'";

        if ($this->votes) {
            $parts['select'].= ", CAST(mv.`meta_value` AS UNSIGNED) as votes";
            $parts['from'].= " INNER JOIN ".gdrts_db()->itemmeta." mv ON mv.`item_id` = i.`item_id` AND mv.`meta_key` = '".$this->_method()."_votes'";

            if (is_numeric($this->args['votes_min']) && $this->args['votes_min'] > 0) {
                $parts['from'].= " AND mv.`meta_value` >= ".$this->args['votes_min'];
            }
        }

        if (!empty($this->args['id__in'])) {
            $parts['where'][] = "i.`id` IN (".join(', ', $this->args['id__in']).")";
        } else if (!empty($this->args['id__not_in'])) {
            $parts['where'][] = "i.`id` NOT IN (".join(', ', $this->args['id__not_in']).")";
        }

        if (is_numeric($this->args['rating_min']) && $this->args['rating_min'] > 0) {
            $parts['where'][] = 'm.`meta_value` >= '.$this->args['rating_min'];
        }

        $order = $this->parse_order();
        $period = $this->parse_period();
        $object = $this->parse_object();

        if ($order['select'] != '') {
            $parts['select'].= $order['select'];
        }

        if ($order['from'] != '') {
            $parts['from'].= $order['from'];
        }

        if (!empty($order['where'])) {
            $parts['where'] = array_merge($parts['where'], $order['where']);
        }

        if (!empty($period['where'])) {
            $parts['where'] = array_merge($parts['where'], $period['where']);
        }

        if ($object['select'] != '') {
            $parts['select'].= $object['select'];
        }

        if ($object['from'] != '') {
            $parts['from'].= $object['from'];
        }

        if (!empty($object['where'])) {
            $parts['where'] = array_merge($parts['where'], $object['where']);
        }

        if ($order['order'] != '') {
            $parts['order'] = $order['order'];
        }

        if (is_numeric($this->args['offset']) > 0 || is_numeric($this->args['limit']) > 0) {
            $parts['limit'] = " LIMIT ".absint($this->args['offset']).", ".absint($this->args['limit']);
        }

        return apply_filters('gdrts_core_query_parts', $parts, $this->args);
    }

    protected function _parse_object_posts($d) {
        $q = array(
            'select' => '', 'from' => ' INNER JOIN '.gdrts_db()->wpdb()->posts.' op ON op.ID = i.id', 'where' => array()
        );

        if (!empty($d['author'])) {
            $q['where'][] = 'op.post_author IN ('.join(', ', $d['author']).')';
        }

        if (!empty($d['status'])) {
            $q['where'][] = "op.post_status IN ('".join("', '", $d['status'])."')";
        }

        if (!empty($d['meta'])) {
            $mid = 1;

            foreach ($d['meta'] as $key => $value) {
                $q['from'].= ' INNER JOIN '.gdrts_db()->wpdb()->postmeta.' om'.$mid.' ON op.ID = om'.$mid.'.post_id';

                $q['where'][] = "om".$mid.".meta_key = '".esc_sql($key)."'";
                $q['where'][] = "om".$mid.".meta_value = '".esc_sql($value)."'";

                $mid++;
            }
        }

        if (!empty($d['terms'])) {
            $q['from'].= ' INNER JOIN '.gdrts_db()->wpdb()->term_relationships.' otr ON op.ID = otr.object_id';
            $q['from'].= ' INNER JOIN '.gdrts_db()->wpdb()->term_taxonomy.' ott ON ott.term_taxonomy_id = otr.term_taxonomy_id';

            $q['where'][] = 'ott.term_id IN ('.join(', ', $d['terms']).')';
        }

        return $q;
    }

    protected function _parse_object_comments($d) {
        $q = array(
            'select' => '', 'from' => ' INNER JOIN '.gdrts_db()->wpdb()->comments.' oc ON oc.comment_ID = i.id', 'where' => array()
        );

        if (!empty($d['author'])) {
            $q['where'][] = 'oc.user_id IN ('.join(', ', $d['author']).')';
        }

        if (!empty($d['meta'])) {
            $mid = 1;

            foreach ($d['meta'] as $key => $value) {
                $q['from'].= ' INNER JOIN '.gdrts_db()->wpdb()->commentmeta.' om'.$mid.' ON oc.comment_ID = om'.$mid.'.comment_id';

                $q['where'][] = "om".$mid.".meta_key = '".esc_sql($key)."'";
                $q['where'][] = "om".$mid.".meta_value = '".esc_sql($value)."'";

                $mid++;
            }
        }

        return $q;
    }

    protected function _parse_object_terms($d) {
        $q = array(
            'select' => '', 'from' => '', 'where' => array()
        );

        $q['from'].= ' INNER JOIN '.gdrts_db()->wpdb()->term_relationships.' otr ON i.id = otr.object_id';
        $q['from'].= ' INNER JOIN '.gdrts_db()->wpdb()->term_taxonomy.' ott ON ott.term_taxonomy_id = otr.term_taxonomy_id';

        if (!empty($d['meta']) && GDRTS_WPV > 43) {
            $mid = 1;

            foreach ($d['meta'] as $key => $value) {
                $q['from'].= ' INNER JOIN '.gdrts_db()->wpdb()->termmeta.' om'.$mid.' ON ott.term_id = om'.$mid.'.term_id';

                $q['where'][] = "om".$mid.".meta_key = '".esc_sql($key)."'";
                $q['where'][] = "om".$mid.".meta_value = '".esc_sql($value)."'";

                $mid++;
            }
        }

        return $q;
    }

    protected function _parse_object_users($d) {
        $q = array(
            'select' => '', 'from' => ' INNER JOIN '.gdrts_db()->wpdb()->users.' ou ON ou.ID = i.id', 'where' => array()
        );

        if (!empty($d['meta'])) {
            $mid = 1;

            foreach ($d['meta'] as $key => $value) {
                $q['from'].= ' INNER JOIN '.gdrts_db()->wpdb()->usermeta.' om'.$mid.' ON ou.ID = om'.$mid.'.user_id';

                $q['where'][] = "om".$mid.".meta_key = '".esc_sql($key)."'";
                $q['where'][] = "om".$mid.".meta_value = '".esc_sql($value)."'";

                $mid++;
            }
        }

        return $q;
    }

    protected function _method() {
        $method = $this->args['method'];

        if (!empty($this->args['series'])) {
            $method.= '-'.$this->args['series'];
        }

        return $method;
    }
}

global $_gdrts_query;

$_gdrts_query = new gdrts_core_query();

function gdrts_query() {
    global $_gdrts_query;
    return $_gdrts_query;
}
