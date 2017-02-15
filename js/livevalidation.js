/**
 *
 * livevalidation.js
 *
 * @author    MT312
 * @copyright MT312
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 * @version   CVS: $Id:$
 * @link      http://www.mt312.com/
 * @see       prototype.js 1.6 (http://www.prototypejs.org/)
 *
 */

var livevalidation = new (function() {
	this.VERSION = '1.0';
	this.list = [];

	if (typeof Prototype != 'object')
		throw new Error('prototype.js is not found.');
})();
livevalidation.register = function(def_list, config) {
	var lv = new this.LiveValidation(def_list, config);
	this.list.push(lv);
	return lv;
};
livevalidation.LiveValidation = Class.create({
	initialize: function(def_list, config) {
		this.def_list = def_list;
		this.define_list = [];
		this.form = null;
		this.config = {
			// ???
			enabled: true,
			// ???????
			first_focus: true,
			// ????????????
			textarea_newlines: true,
			// ??????????
			textarea_resizing: true,
			// ?????????
			text_counter: true,
			// ??????????? change blur keyup
			text_event: 4,
			// ??????????
			maxlength: true,
			// ????????????????
			error_boxmove: false,
			// ?????????
			error_pos: true,
			// ????????????
			done_mark: ' ',
			// ??????????
			wrapper_element: 'TD DD DIV',
			// ????????????
			action_path: ''
		};
		Object.extend(this.config, config || {});
		Event.observe(window, 'load', this.dispatch.bind(this));
	},
	dispatch: function() {
		var self = this;
		if (this.config.enabled == false) return false;
		if (this.def_list.length == 0) return false;
		var first_el = $(this.def_list[0].id);
		if (first_el == null) return false;
		if (typeof first_el.form == 'undefined') {
			var elems = first_el.getElementsBySelector('input');
			if (elems.length == 0) return false;
			first_el = elems[0];
		}
		this.form = first_el.form;

		var validate = function(define, def) {
			var el = define.el;
			var config = define.config;
			return function(ev) {
				if (ev.keyCode == Event.KEY_TAB) return true;
				if (ev.keyCode == Event.KEY_RETURN && el.tagName != 'TEXTAREA') return true;

				var err_el = $(el.id + '_error');
				var has_err = err_el != null && err_el.tagName == 'EM';
				for (var prop in def) {
					if (define[prop] == null) continue;
					var method_name = prop + '_check';
					if (typeof define[method_name] != 'function') continue;
					var result = define[method_name](ev);
					if (result === null) break;
					if (result === true) continue;

					var msg = define[prop + '_error'] + '?';
					msg = msg.replace('{form}', define.name);
					msg = msg.replace('%d', define[prop]);
					if (!has_err) {
						err_el = document.createElement('em');
						err_el.id = el.id + '_error';
						var parent_el = define.parent_el;
						if (config.error_boxmove) {
							parent_el = Element.previous(parent_el);
						}
						if (config.error_pos) {
							var first_el = parent_el.firstChild;
							// ???????????
							while (typeof first_el.tagName == 'string' && first_el.tagName == 'EM') {
								first_el = first_el.nextSibling;
							}
							parent_el.insertBefore(err_el, first_el);
						} else {
							parent_el.appendChild(err_el);
						}
					}
					err_el.className = 'error';
					err_el.innerHTML = msg;
					Element.removeClassName(el, 'done');
					Element.addClassName(el, 'error');
					return false;
				}
				if (has_err && err_el.className == 'error') {
					if (config.done_mark != '') {
						err_el.className = 'done';
						err_el.innerHTML += config.done_mark;
						Element.removeClassName(el, 'error');
						Element.addClassName(el, 'done');
					} else {
						Element.remove(err_el);
						Element.removeClassName(el, 'error');
					}
				}
				return true;
			};
		};

		var parentNodeOf = function(el) {
			var wrapper = self.config.wrapper_element;
			do {el = el.parentNode;}
			while (wrapper.indexOf(el.tagName) == -1);
			return el;
		};
		this.def_list.each(function(def) {
			if (typeof def.id != 'string') return;
			var el = $(def.id);
			if (el == null) return;

			// ??????
			var def_type = 'none';
			var tag = el.tagName;
			if (tag == 'INPUT') {
				if (el.type == 'hidden') return;
				if (el.type == 'file') {
					def_type = 'file';
				} else {
					def_type = 'text';
				}
			} else if (tag == 'SELECT') {
				if (el.multiple) {
					el.inner_nodes = $A(el.options);
					def_type = 'multibox';
				} else {
					def_type = 'select';
				}
			} else if (tag == 'SPAN') {
				var elems = el.getElementsBySelector('input');
				if (elems.length == 0) return;
				el.inner_nodes = elems;
				def_type = elems[0].type;
			} else if (tag == 'TEXTAREA') {
				def_type = 'textarea';
			}
			var class_name = 'Define_' + def_type;
			if (typeof livevalidation[class_name] != 'function') return;
			var define = new livevalidation[class_name]();
			Object.extend(define, def);

			define.parent_el = parentNodeOf(el);
			define.el = el;
			define.config = self.config;
			define.validate = validate(define, def);
			define.observe();
			self.define_list.push(define);
		});
		if (this.define_list.length == 0) return false;
		if (this.config.action_path != '') this.form.action = this.config.action_path;
		if (this.config.first_focus) this.focusFirstElement();

		// Opera?keydown?Event.stop?????
		Event.observe(this.form, 'keypress', function(ev) {
			if (ev.keyCode != Event.KEY_RETURN) return true;
			var el = Event.element(ev);
			if (el.tagName == 'TEXTAREA') return true;
			if (el.tagName == 'INPUT' && (el.type == 'reset' || el.type == 'submit' || el.type == 'image')) return true;

			// ??????????????
			var elems = Form.getElements(el.form);
			var i = elems.indexOf(el) + 1;
			var l = elems.length;
			for (; i < l; ++i) {
				var el = elems[i];
				if (el.style.display == 'none' || el.disabled) continue;
				el.focus();
				break;
			}
			// submit???????????
			Event.stop(ev);
			return false;
		}, false);
		Event.observe(this.form, 'reset', function(ev) {
			if (confirm('??????????????') == false) {
				Event.stop(ev);
				return false;
			}
			// IE???????????????????
			self.focusFirstElement();
			self.define_list.each(function(define) {
				var el = define.el;
				var err_el = $(el.id + '_error');
				var has_err = err_el != null && err_el.tagName == 'EM';
				if (has_err) {
					Element.remove(err_el);
					Element.removeClassName(el, 'error');
					Element.removeClassName(el, 'done');
				}
			});
			Element.scrollTo(this);
			return true;
		});
		Event.observe(this.form, 'submit', function(ev) {
			// Safari??form
			var button = document.activeElement || ev.explicitOriginalTarget || this;
			button.disabled = true;
			var error = null;
			self.define_list.each(function(define) {
				if (define.validate(ev) == false && error == null) {
					error = define;
				}
			});
			button.disabled = false;

			// Event.stop(ev);
			if (error == null) return true;

			var el = error.el;
			if (el.tagName == 'SPAN') {
				el = el.inner_nodes[0];
			}
			try {
				el.focus();
			} catch (e) {
			}

			el = Element.previous(error.parent_el);
			el_y = el.cumulativeOffset()[1];
			var sc_y = document.documentElement.scrollTop || document.body.scrollTop;
			if (el_y < sc_y) {
				Element.scrollTo(el);
			}
			Event.stop(ev);
			return false;
		});
		livevalidation.dispatchUtilEvent();
		return true;
	},
	focusFirstElement: function() {
		var elems = Form.getElements(this.form);
		var el = elems.find(function(el) {
			return el.style.display != 'none' && el.disabled == false && el.type != 'hidden' && el.type != 'submit';
		});
		if (typeof el == 'undefined') return null;
		el.focus();
		return el;
	}
});
livevalidation.dispatchUtilEvent = function() {
	for (var name in this.util) {
		var el = $('livevalidation-' + name);
		if (el == null) continue;
		el.onclick = this.util[name];
		el.onclick();
	}
};
livevalidation.util = {
	mailer: function(subject, body) {
		var rot13 = function(s) {
			return s.replace(/[a-z]/ig, function(c) {
				var n;
				return String.fromCharCode((n = c.charCodeAt(0) + 13) > (c <= 'Z' ? 90 : 122) ? n - 26 : n);
			});
		};

		to = this.title;
		to = 'znvygb;' + to;
		to = to.replace(/\*/g, '@');
		to = to.replace(/\:/g, '.');
		to = to.replace(/\;/g, ':');
		to = rot13(to);
		if (typeof subject == 'string') {
			to += '?subject=' + subject + '&';
		}
		if (typeof body == 'string') {
			to += 'body=' + body + '&';
		}
		this.onclick = function() {
			if (confirm('???????????')) {
				location.href = to;
			}
		};
	},
	checksAllOn: function() {
		var el = $(this.title);
		if (el == null && typeof el.inner_nodes == 'undefined') return;
		var key = el.tagName == 'SPAN' ? 'checked' : 'selected';
		this.onclick = function() {
			el.inner_nodes.each(function(node) {
				node[key] = true;
			});
		};
	},
	checksAllOff: function() {
		var el = $(this.title);
		if (el == null && typeof el.inner_nodes == 'undefined') return;
		var key = el.tagName == 'SPAN' ? 'checked' : 'selected';
		this.onclick = function() {
			el.inner_nodes.each(function(node) {
				node[key] = false;
			});
		};
	},
	toggleOptionalItem: function() {
		if (livevalidation.list.length == 0) return;
		var self = livevalidation.list[0];
		var closed_msg = this.title || '[???????]';
		var opened_msg = this.innerHTML;
		var list = [];
		var tmp = null;
		self.define_list.each(function(define) {
			var parent_el = define.parent_el;
			// ?????????????????????
			if (parent_el == tmp) return;
			tmp = parent_el;
			if (define.required) return;

			// ???????toggle
			if (define.el.tagName == 'SPAN') {
				list = list.concat(define.el.inner_nodes);
			} else {
				list.push(define.el);
			}

			// ???????toggle
			if (parent_el.tagName == 'TD') {
				list.push(parent_el.parentNode);
			} else if (parent_el.tagName == 'DD') {
				list.push(Element.previous(parent_el));
				list.push(parent_el);
			} else {
				list.push(parent_el);
			}
		});
		var n = 0;
		var msg = [opened_msg, closed_msg];
		this.title = msg[n];
		this.onclick = function() {
			this.title = msg[n ^= 1];
			this.innerHTML = msg[n];
			list.each(function(el) {Element.toggle(el);});
			self.focusFirstElement();
		};
	}
};
livevalidation.Define = Class.create({
	initialize: function() {
	},
	observe: function() {
	},
	required: false,
	required_error: '{form}????????',
	required_check: function() {
		var str = this.el.value;
		if (this.required) return str != '';
		if (str == '') return null;
		return true;
	},
	min: 0,
	min_error: '{form}?%d??????????',
	min_check: function() {
		return this.el.value.length >= this.min;
	},
	max: 5000,
	max_error: '{form}?%d??????????',
	max_check: function() {
		return this.el.value.length <= this.max;
	}
});
livevalidation.Define_text = Class.create(livevalidation.Define, {
	observe: function() {
		var self = this;
		var el = this.el;
		var config = this.config;
		var ev = config.text_event;
		if ((ev & 1) == 1) Event.observe(el, 'keyup', this.validate);
		if ((ev & 2) == 2) Event.observe(el, 'blur', this.validate);
		if ((ev & 4) == 4) Event.observe(el, 'change', this.validate);

		if (typeof this.watermark == 'string' && el.value == '') {
			var reset = function() {
				Element.addClassName(el, 'watermark');
			};
			var setin = function() {
				if (el.value == '') {
					el.value = self.watermark;
					Element.addClassName(el, 'watermark');
				}
			};
			var clear = function() {
				if (Element.hasClassName(el, 'watermark')) {
					el.value = '';
					Element.removeClassName(el, 'watermark');
				}
			};
			reset();
			el.value = el.defaultValue = this.watermark;
			Event.observe(el, 'focus', clear);
			Event.observe(el, 'blur', setin);
			Event.observe(el.form, 'reset', reset);
		}
		if (typeof this.max == 'number' && this.max > 0) {
			if (config.maxlength && el.tagName == 'INPUT') {
				el.maxLength = this.max;
			}
			if (config.text_counter) {
				var count = function() {
					var len = this.value.length;
					var max = self.max;
					var rate = Math.floor(len / max * 100);
					window.status = len + '/' + max + ' ' + rate + '%';
				};
				var clear = function() {
					window.status = '';
				};
				Event.observe(el, 'focus', count);
				Event.observe(el, 'keyup', count);
				Event.observe(el, 'blur', clear);
			}
		}
	},
	required_check: function() {
		if (Element.hasClassName(this.el, 'watermark')) {
			this.el.value = '';
		}
		var str = this.el.value;
		str = this.converter.trim(str);
		if (this.required) return str != '';
		if (str == '') return null;
		return true;
	},
	regexp: null,
	regexp_error: '{form}?????????',
	regexp_check: function() {
		var regexp = this.regexp;
		if (regexp in this.regexp_list) {
			var str = this.el.value;
			str = this.converter.trim(str);
			if (regexp == 'hiragana') {
				str = this.converter.hiragana(str);
			} else if (regexp == 'katakana') {
				str = this.converter.katakana(str);
			} else {
				str = this.converter.zentohan(str);
			}
			return this.regexp_list[regexp].test(str);
		}
		return true;
	},
	repeat: false,
	repeat_error: '{form}?????????',
	repeat_check: function() {
		var elems = Form.getElements(this.el.form);
		var n = elems.indexOf(this.el);
		return n > 0 && (elems[n - 1].value == this.el.value);
	},
	regexp_list: {
		mailaddress: /^([a-z\d_]|\-|\.|\+)+@(([a-z\d_]|\-)+\.)+[a-z]{2,6}$/i,
		url: /^(https?|ftp):\/\/\S+$/,
		alphabet: /^[a-z]+$/i,
		alphanum: /^[a-z\d]+$/i,
		number: /^\d+$/,
		integer: /^[1-9]\d*$/,
		zipcode: /^\d{3}-\d{4}$/,
		zipcode_d: /^\d{7}$/,
		phone:   /^0[1-9]\d{0,4}-(\d{1,4}-)?\d{4}$/,
		phone_d: /^0[1-9]\d{8,9}$/,
		mbphone:   /^0[7-9]0-\d{4}-\d{4}$/,
		mbphone_d: /^0[7-9]0\d{8}$/,
		katakana: /^[?-?  ?]+$/,
		hiragana: /^[?-?  ?]+$/
	},
	converter: {
		trim: function(str) {
			// str = str.replace(/^[\s ]+|[\s ]+$/, '');
			str = str.replace(/^[\s ]+/, '');
			str = str.replace(/[\s ]+$/, '');
			return str;
		},
		zentohan: function(str) {
			var zen = '!”#$%&’()=^~/*-+.,?_@;: ';
			var han = '!"#$%&\'()=^~/*-+.,?_@;: ';
			var reg = new RegExp('[' + zen + ']', 'g');
			str = str.replace(reg, function($0) {
				return han.charAt(zen.indexOf($0));
			});
			return str.replace(/[A-Za-z0-9]/g, function($0) {
				return String.fromCharCode($0.charCodeAt(0) - 0xFEE0);
			});
		},
		hiragana: function(str) {
			return str.replace(/[?-?]/g, function($0) {
				return String.fromCharCode($0.charCodeAt(0) - 0x0060);
			});
		},
		katakana: function(str) {
			return str.replace(/[?-?]/g, function($0) {
				return String.fromCharCode($0.charCodeAt(0) + 0x0060);
			});
		}
	}
});
livevalidation.Define_textarea = Class.create(livevalidation.Define_text, {
	observe: function($super) {
		$super();
		var self = this;
		var el = this.el;

		if (this.config.textarea_resizing) {
			var min_rows = el.rows;
			var max_rows = min_rows * 3;
			var resize =  function(ev) {
				if (ev.type == 'keyup') {
					var key = ev.keyCode;
					if (key != Event.KEY_BACKSPACE && key != Event.KEY_RETURN && key != Event.KEY_DELETE) return;
				}
				var match = this.value.match(/\r\n?|\n/g);
				if (match != null) {
					var lines = match.length + 2;
					this.rows = Math.max(min_rows, Math.min(lines, max_rows));
				}
			};
			Event.observe(el, 'focus', resize);
			Event.observe(el, 'keyup', resize);
			Event.observe(el, 'mouseup', resize);
			Event.observe(el, 'change', resize);
		}
		if (this.config.textarea_newlines && el.value == '') {
			var rows = el.rows;
			rows = Math.min(rows - 1, 8);
			rows = Math.ceil(rows / 1.5);
			rows.times(function(n) {el.value += '\n';});
		}
	}
});
livevalidation.Define_select = Class.create(livevalidation.Define, {
	observe: function() {
		Event.observe(this.el, 'change', this.validate);
	},
	required_error: '{form}????????'
});
livevalidation.Define_radio = Class.create(livevalidation.Define, {
	observe: function() {
		var self = this;
		this.el.inner_nodes.each(function(node) {
			Event.observe(node, 'click', self.validate);
		});
	},
	required_error: '{form}????????',
	required_check: function() {
		var checked = false;
		this.el.inner_nodes.each(function(node) {
			if (node.checked) {
				if (node.value == '') {
					node.checked = false;
					return;
				}
				checked = true;
				return;
			}
		});
		if (this.required) return checked;
		if (!checked) return null;
		return true;
	},
	min_check: function() {
		var length = 0;
		this.el.inner_nodes.each(function(node) {
			if (node.checked) {
				length = node.value.length;
				return;
			}
		});
		return length >= this.min;
	},
	max_check: function() {
		var length = 0;
		this.el.inner_nodes.each(function(node) {
			if (node.checked) {
				length = node.value.length;
				return;
			}
		});
		return length <= this.max;
	}
});
livevalidation.Define_checkbox = Class.create(livevalidation.Define, {
	observe: function() {
		var self = this;
		this.el.inner_nodes.each(function(node) {
			Event.observe(node, 'click', self.validate);
		});
	},
	check: 'checked',

	required_error: '{form}????????',
	required_check: function() {
		var exists = false;
		var ck = this.check;
		this.el.inner_nodes.each(function(node) {
			if (node[ck]) {
				// $F(node)?<option>??????
				if (node.value == '') {
					node[ck] = false;
					return;
				}
				exists = true;
				return;
			}
		});
		if (this.required) return exists;
		if (!exists) return null;
		return true;
	},
	min_check: function() {
		var ret = true;
		var min = this.min;
		var ck = this.check;
		this.el.inner_nodes.each(function(node) {
			if (node[ck] && node.value.length < min) {
				ret = false;
				return;
			}
		});
		return ret;
	},
	max_check: function() {
		var ret = true;
		var max = this.max;
		var ck = this.check;
		this.el.inner_nodes.each(function(node) {
			if (node[ck] && node.value.length > max) {
				ret = false;
				return;
			}
		});
		return ret;
	},
	checks_min_error: '{form}?%d???????????',
	checks_min_check: function() {
		if (this.checks_min < 2) return true;
		var checks = 0;
		var ck = this.check;
		this.el.inner_nodes.each(function(node) {
			if (node[ck]) ++checks;
		});
		return checks >= this.checks_min;
	},
	checks_max_error: '{form}?%d???????????',
	checks_max_check: function() {
		if (this.checks_max < 2) return true;
		var checks = 0;
		var ck = this.check;
		this.el.inner_nodes.each(function(node) {
			if (node[ck]) ++checks;
		});
		return checks <= this.checks_max;
	}
});
livevalidation.Define_multibox = Class.create(livevalidation.Define_checkbox, {
	observe: function() {
		Event.observe(this.el, 'change', this.validate);
	},
	check: 'selected'
});
livevalidation.Define_file = Class.create(livevalidation.Define, {
	observe: function() {
		Event.observe(this.el, 'change', this.validate);
	},
	required_error: '{form}????????',
	min: null,
	min_check: null,
	max: null,
	max_check: null
});