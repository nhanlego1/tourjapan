/*
 * Chu y link:
 * Dat script spymaster.js o tren phan head
 * Dat script tracking.js ngay sau spymaster.js
 * Moi ham tracking duoc goi o trong document ready

 * Chu y tracking:
 * 1. Bat buoc phai goi setup_tracking truoc khi tracking
 * 2. Goi track C2 ngay sau khi setup
 * 3. Goi track C3 ngay sau ham goi send_c3
 * 4. Phan biet C3 va c3_cod de goi ham thich hop
 * 5. Dam bao course_id la bien toan cuc
 * 6. Goi track_click_video khi co su kien click xay ra
 *
 * Khi tao 1 landing moi
 * 1. Copy tracing.js vao landing page moi
 * 2. Khai 2 script spymaster.js va tracking.js tren dau
 * 3. Thu tu dat tracking giong file mau
 *
 * * Thay doi trong file nay thi thong bao Hai LN
 */


// Truyen vao extras dang json


// validate Phone 

// set countdown
 var auto_time = function () {
    var current_date = new Date();

    var first_months = current_date.getMonth() + 1;
    var first_days = 01;
    var first_years = 2016;

    var end_days = 0;
    var part_of_day = 1;

    var current_days = current_date.getDate();

    var diff = current_days - first_days
    if( diff%part_of_day != 0 ) {
      end_days = ((diff - diff%part_of_day)/part_of_day + 1)*part_of_day + 1
    }
    else {
      end_days = (diff/part_of_day)*part_of_day + 1
    }
    return end_days+"/"+first_months+"/"+first_years;
  }

  function saleCoundownter(duration, ondisplay, ontimeout) {
    var timer = duration,
      days, hours, minutes, seconds;
    var interval = setInterval(function () {
      if (--timer < 0) {
        ontimeout ? ontimeout() : null
        clearInterval(interval);
        return;
      }

      days = parseInt(timer / 60 / 60 / 24, 10)
      hours = parseInt(timer / 60 / 60 % 24, 10)
      minutes = parseInt(timer / 60 % 60, 10);
      seconds = parseInt(timer % 60, 10);

      days = days;
      hours = hours;
      minutes = minutes;
      seconds = seconds;

      ondisplay(days, hours, minutes, seconds);

    }, 1000);
  };