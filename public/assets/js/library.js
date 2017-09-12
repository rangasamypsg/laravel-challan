var pathArray = window.location.pathname.split( '/' );
var baseUrl = window.location.protocol + "//" + window.location.host + "/" + pathArray[1] + "/public/";
//alert(baseUrl);
var LIBS = {
	// Chart libraries
	plot: [
		baseUrl+"libs/misc/flot/jquery.flot.min.js",
		baseUrl+"libs/misc/flot/jquery.flot.pie.min.js",
		baseUrl+"libs/misc/flot/jquery.flot.stack.min.js",
		baseUrl+"libs/misc/flot/jquery.flot.resize.min.js",
		baseUrl+"libs/misc/flot/jquery.flot.curvedLines.js",
		baseUrl+"libs/misc/flot/jquery.flot.tooltip.min.js",
		baseUrl+"libs/misc/flot/jquery.flot.categories.min.js"
	],
	chart: [
		baseUrl+"libs/misc/echarts/build/dist/echarts-all.js",
		baseUrl+"libs/misc/echarts/build/dist/theme.js",
		baseUrl+"libs/misc/echarts/build/dist/jquery.echarts.js"
	],
	circleProgress: [
		baseUrl+"libs/bower/jquery-circle-progress/dist/circle-progress.js"
	],
	sparkline: [
		baseUrl+"libs/misc/jquery.sparkline.min.js"
	],
	maxlength: [
		baseUrl+"libs/bower/bootstrap-maxlength/src/bootstrap-maxlength.js"
	],
	tagsinput: [
		baseUrl+"libs/bower/bootstrap-tagsinput/dist/bootstrap-tagsinput.css",
		baseUrl+"libs/bower/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js",
	],
	TouchSpin: [
		baseUrl+"libs/bower/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css",
		baseUrl+"libs/bower/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"
	],
	selectpicker: [
		baseUrl+"libs/bower/bootstrap-select/dist/css/bootstrap-select.min.css",
		baseUrl+"libs/bower/bootstrap-select/dist/js/bootstrap-select.min.js"
	],
	filestyle: [
		baseUrl+"libs/bower/bootstrap-filestyle/src/bootstrap-filestyle.min.js"
	],
	timepicker: [
		baseUrl+"libs/bower/bootstrap-timepicker/js/bootstrap-timepicker.js"
	],
	datetimepicker: [
		baseUrl+"libs/bower/moment/moment.js",
		baseUrl+"libs/bower/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css",
		baseUrl+"libs/bower/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"
	],
	select2: [
		baseUrl+"libs/bower/select2/dist/css/select2.min.css",
		baseUrl+"libs/bower/select2/dist/js/select2.full.min.js"
	],
	vectorMap: [
		baseUrl+"libs/misc/jvectormap/jquery-jvectormap.css",
		baseUrl+"libs/misc/jvectormap/jquery-jvectormap.min.js",
		baseUrl+"libs/misc/jvectormap/maps/jquery-jvectormap-us-mill.js",
		baseUrl+"libs/misc/jvectormap/maps/jquery-jvectormap-world-mill.js",
		baseUrl+"libs/misc/jvectormap/maps/jquery-jvectormap-africa-mill.js"
	],
	summernote: [
		baseUrl+"libs/bower/summernote/dist/summernote.css",
		baseUrl+"libs/bower/summernote/dist/summernote.min.js"
	],
	DataTable: [
		baseUrl+"libs/misc/datatables/datatables.min.css",
		baseUrl+"libs/misc/datatables/datatables.min.js"
	],
	fullCalendar: [
		baseUrl+"libs/bower/moment/moment.js",
		baseUrl+"libs/bower/fullcalendar/dist/fullcalendar.min.css",
		baseUrl+"libs/bower/fullcalendar/dist/fullcalendar.min.js"
	],
	dropzone: [
		baseUrl+"libs/bower/dropzone/dist/min/dropzone.min.css",
		baseUrl+"libs/bower/dropzone/dist/min/dropzone.min.js"
	],
	counterUp: [
		baseUrl+"libs/bower/waypoints/lib/jquery.waypoints.min.js",
		baseUrl+"libs/bower/counterup/jquery.counterup.min.js"
	],
	others: [
		baseUrl+"libs/bower/switchery/dist/switchery.min.css",
		baseUrl+"libs/bower/switchery/dist/switchery.min.js",
		baseUrl+"libs/bower/lightbox2/dist/css/lightbox.min.css",
		baseUrl+"libs/bower/lightbox2/dist/js/lightbox.min.js"
	]
};