paceOptions = {
  restartOnPushState: true,
  ajax: true,
  document: true,
  restartOnRequestAfter: true,
  eventLag: true,
};

function toast_error(pesan) {
  $(document).Toasts("create", {
    class: "bg-danger",
    title: "Error",
    icon: "fas fa-help fa-lg",
    autohide: true,
    delay: 4000,
    body: pesan,
  });
}

function toast_warning(pesan) {
  $(document).Toasts("create", {
    class: "bg-warning",
    title: "Warning",
    icon: "fas fa-exclamation-triangle fa-lg",
    autohide: true,
    body: pesan,
  });
}

function toast_success(pesan) {
  $(document).Toasts("create", {
    class: "bg-success",
    title: "Success",
    icon: "fas fa-check fa-lg",
    autohide: true,
    delay: 4000,
    body: pesan,
  });
}

// $.ajaxSetup({
// error: function () {
//   toast_error('Server Error, ulangi kembali');
// }
// });

$(function () {
  $(".btn-popup-top").tooltip({
    placement: "top",
  });
  $.validator.setDefaults({
    errorElement: "span",
    errorPlacement: function (error, element) {
      error.addClass("invalid-feedback");
      element.closest(".form-group").append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass("is-invalid");
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass("is-invalid");
    },
    lang: "id",
  });

  $.extend($.validator.messages, {
    required: "Wajib diisi",
    email: "Mohon masukkan alamat email yang benar",
    url: "Mohon masukkan alamat URL yang benar",
    date: "Mohon masukkan tanggal yang benar",
    number: "Mohon masukkan angka yang benar",
    digits: "Maaf, Hanya angka",
    equalTo: "Tidak cocok",
    maxlength: $.validator.format("Maksimal {0} karakter"),
    minlength: $.validator.format("Minimal {0} karakter"),
    max: $.validator.format("Maksimal {0} atau bisa {0} digit"),
    min: $.validator.format("Minimal {0} atau bisa {0} digit"),
  });
});

$(".openbtn").on("click", function () {
  $(".ui.sidebar").toggleClass("very thin icon");
  $(".asd").toggleClass("marginlefting");
  $(".sidebar z").toggleClass("displaynone");
  $(".ui.accordion").toggleClass("displaynone");
  $(".ui.dropdown.item").toggleClass("displayblock");
  $(".logo").find("img").toggle();
});

var $duration = 1000;

$(document).ready(function () {
  $(".user-navbar").dropdown({
    on: "hover",
    action: "hide",
  });
});

$(document).on("click", ".btn-openWin", function (e) {
  e.preventDefault();
  let url = $(this).data("url");
  var height = screen.height;
  var width = screen.width;
  var left, top, win;

  if (width > 1050) {
    width = width - 200;
  } else {
    width = 850;
  }

  if (height > 850) {
    height = height - 150;
  } else {
    height = 700;
  }

  if (window.screenX < 0) {
    left = (window.screenX - width) / 2;
  } else {
    left = (screen.width - width) / 2;
  }
  if (window.screenY < 0) {
    top = (window.screenY + height) / 4;
  } else {
    top = (screen.height - height) / 4;
  }
  win = window.open(
    url,
    "name",
    "width=" +
      width +
      ", height=" +
      height +
      ",left=" +
      left +
      ",top=" +
      top +
      "toolbar=no, menubar=no, directories=no, status=no, copyhistory=no, location=yes, resizable=yes, scrollbars=yes"
  );
  if (win.focus) {
    win.focus();
  }
  return false;
});

var date = new Date();
var currentDay = date.getDate();
var currentMonth = date.getMonth();
var currentYear = date.getFullYear();
var currentDate =
  currentYear + "-" + Number(currentMonth + 1) + "-" + currentDay;
var disabledMonth = [];

for (let index = 0; index < 12; index++) {
  if (index < currentMonth) {
    disabledMonth.push(index);
  }
}

var disabledYear = [];

for (let index = 1; index < 11; index++) {
  disabledYear.push(Number(currentYear) - index);
}

for (let index = 1; index < 11; index++) {
  disabledYear.push(Number(currentYear) + index);
}

$(document).on("select2:open", () => {
  document.querySelector(".select2-search__field").focus();
});
