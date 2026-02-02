<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Application Name
	|--------------------------------------------------------------------------
	|
	| This value is the name of your application. This value is used when the
	| framework needs to place the application's name in a notification or
	| any other location as required by the application or its packages.
	|
	*/

	'name' => env('APP_NAME', 'Jobick Laravel'),

	'public' => [
		'global' => [
			'css' => [
					'vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
					'vendor/bootstrap-datepicker-master/css/bootstrap-datepicker.min.css',
			],
			'js' => [
				'top'=> [
					'vendor/global/global.min.js',
					'vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'vendor/bootstrap-datepicker-master/js/bootstrap-datepicker.min.js',
				],
				'bottom'=> [
					'js/custom.min.js',
					'js/dlabnav-init.js',
				],
			],
		],
		'pagelevel' => [
			'css' => [
				'JobickAdminController_dashboard' => [
					'vendor/bootstrap-datepicker-master/css/bootstrap-datepicker.min.css',
					'vendor/owl-carousel/owl.carousel.css',
					
				],
				'JobickAdminController_dashboard_2' => [
					'vendor/bootstrap-datepicker-master/css/bootstrap-datepicker.min.css',
					'vendor/owl-carousel/owl.carousel.css',
				],
				'JobickAdminController_application_page' => [
					'vendor/datatables/css/jquery.dataTables.min.css',
				],
				'JobickAdminController_app_calender' => [
					'vendor/fullcalendar/css/main.min.css'
				],
				'JobickAdminController_celandar' => [
					'vendor/fullcalendar-5.11.0/lib/main.css',
					'vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css'
				],
				'JobickAdminController_job_list'=>[
					'vendor/datatables/css/jquery.dataTables.min.css'
				],
				'JobickAdminController_job_application'=>[
					'vendor/datatables/css/jquery.dataTables.min.css',
				],
				'JobickAdminController_student_detail'=>[
					'vendor/datatables/css/jquery.dataTables.min.css',
					'vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css',
				],
				'JobickAdminController_add_blog'=>[
					'vendor/select2/css/select2.min.css',
				],
				'JobickAdminController_edit_profile' => [
					'vendor/bootstrap-datepicker-master/css/bootstrap-datepicker.min.css',
					
				],
				'JobickAdminController_app_profile' => [
					'vendor/lightgallery/css/lightgallery.min.css',
					
				],
				
				'JobickAdminController_post_details' => [
					'vendor/lightgallery/css/lightgallery.min.css',
					
				],
				'JobickAdminController_menu' => [
					'vendor/nestable2/css/jquery.nestable.min.css',
					
				],
				'JobickAdminController_add_teacher' => [
					'vendor/bootstrap-datepicker-master/css/bootstrap-datepicker.min.css',
					
				],
				'JobickAdminController_blog_category' => [
					'vendor/datatables/css/jquery.dataTables.min.css',
					
				],

				'JobickAdminController_chart_chartist' => [
					'vendor/chartist/css/chartist.min.css'
				],
				'JobickAdminController_chart_chartjs' => [
				],
				'JobickAdminController_chart_flot' => [
				],
				'JobickAdminController_chart_morris' => [
				],
				'JobickAdminController_chart_peity' => [
				],
				'JobickAdminController_chart_sparkline' => [
				],
				'JobickAdminController_ecom_checkout' => [
				],
				'JobickAdminController_ecom_customers' => [
				],
				'JobickAdminController_ecom_invoice' => [
					
				],
				'JobickAdminController_ecom_product_detail' => [
					'vendor/star-rating/star-rating-svg.css',
					'vendor/owl-carousel/owl.carousel.css',
				],
				'JobickAdminController_ecom_product_grid' => [
				],
				'JobickAdminController_ecom_product_list' => [
					'vendor/star-rating/star-rating-svg.css'
				],
				'JobickAdminController_ecom_product_order' => [
				],
				'JobickAdminController_email_compose' => [
					'vendor/dropzone/dist/dropzone.css'
				],
				'JobickAdminController_email_inbox' => [
					
				],
				'JobickAdminController_email_read' => [
				],
				'JobickAdminController_editor' => [
					
				],
				'JobickAdminController_form_element' => [
				],
				'JobickAdminController_form_pickers' => [
					'vendor/bootstrap-daterangepicker/daterangepicker.css',
					'vendor/clockpicker/css/bootstrap-clockpicker.min.css',
					'vendor/jquery-asColorPicker/css/asColorPicker.min.css',
					'vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
					'vendor/pickadate/themes/default.css',
					'vendor/pickadate/themes/default.date.css',
					'https://fonts.googleapis.com/icon?family=Material+Icons',
				],
				'JobickAdminController_email_template' => [
					'vendor/datatables/css/jquery.dataTables.min.css',
					'vendor/bootstrap-datepicker-master/css/bootstrap-datepicker.min.css',
				],
				'JobickAdminController_blog' => [
					'vendor/datatables/css/jquery.dataTables.min.css',
					'vendor/bootstrap-datepicker-master/css/bootstrap-datepicker.min.css',
				],
				'JobickAdminController_content' => [
					
					
					
				],
				'JobickAdminController_form_validation_jquery' => [
				],
				'JobickAdminController_form_wizard' => [
					'vendor/jquery-smartwizard/dist/css/smart_wizard.min.css',
					
				],
				'JobickAdminController_map_jqvmap' => [
					'vendor/jqvmap/css/jqvmap.min.css'
				],
				'JobickAdminController_page_error_400' => [
					'vendor/bootstrap-select/dist/css/bootstrap-select.min.css'
				],
				'JobickAdminController_table_bootstrap_basic' => [
					
				],
				'JobickAdminController_table_datatable_basic' => [
					'vendor/datatables/css/jquery.dataTables.min.css',
					'vendor/datatables/responsive/responsive.css',
					
				],
				'JobickAdminController_uc_lightgallery' => [
					'vendor/lightgallery/css/lightgallery.min.css',
					
				],
				'JobickAdminController_uc_nestable' => [
					'vendor/nestable2/css/jquery.nestable.min.css'
				],
				'JobickAdminController_uc_noui_slider' => [
					'vendor/nouislider/nouislider.min.css'
				],
				'JobickAdminController_uc_select2' => [
					'vendor/select2/css/select2.min.css'
				],
				'JobickAdminController_uc_sweetalert' => [
					'vendor/sweetalert2/dist/sweetalert2.min.css'
				],
				'JobickAdminController_uc_toastr' => [
					'vendor/toastr/css/toastr.min.css'
				],
				
				'JobickAdminController_ui_accordion' => [
				],
				'JobickAdminController_ui_alert' => [
				],
				'JobickAdminController_ui_badge' => [
				],
				'JobickAdminController_ui_button' => [
				],
				'JobickAdminController_ui_button_group' => [
				],
				'JobickAdminController_ui_card' => [
				],
				'JobickAdminController_ui_carousel' => [
				],
				'JobickAdminController_ui_dropdown' => [
				],
				'JobickAdminController_ui_grid' => [
				],
				'JobickAdminController_ui_list_group' => [
				],
				'JobickAdminController_ui_media_object' => [
				],
				'JobickAdminController_ui_modal' => [
				],
				'JobickAdminController_ui_pagination' => [
				],
				'JobickAdminController_ui_popover' => [
				],
				'JobickAdminController_ui_progressbar' => [
				],
				'JobickAdminController_ui_tab' => [
				],
				'JobickAdminController_ui_typography' => [
				],
				'JobickAdminController_widget_basic' => [
					'vendor/chartist/css/chartist.min.css',
				],
			],
			'js' => [
				'JobickAdminController_dashboard' => [
					'vendor/bootstrap-datepicker-master/js/bootstrap-datepicker.min.js',
					'vendor/apexchart/apexchart.js',
					'vendor/chartjs/chart.bundle.min.js',
					'vendor/peity/jquery.peity.min.js',
					'js/dashboard/dashboard-1.js',
					'vendor/owl-carousel/owl.carousel.js',
				],
				'JobickAdminController_dashboard_2' => [
					'vendor/bootstrap-datepicker-master/js/bootstrap-datepicker.min.js',
					'vendor/apexchart/apexchart.js',
					'vendor/chartjs/chart.bundle.min.js',
					'vendor/peity/jquery.peity.min.js',
					'js/dashboard/dashboard-1.js',
					'vendor/owl-carousel/owl.carousel.js',
				],
				
				
				'JobickAdminController_application_page' => [
					'vendor/datatables/js/jquery.dataTables.min.js',
					'js/plugins-init/datatables.init.js',
					
				],
				'JobickAdminController_statistics_page'=>[
					'vendor/apexchart/apexchart.js',
					'vendor/chartjs/chart.bundle.min.js',
					'vendor/peity/jquery.peity.min.js',
					'js/dashboard/statistics-page.js',
				],
				'JobickAdminController_job_list'=>[
					'vendor/datatables/js/jquery.dataTables.min.js',
					'js/plugins-init/datatables.init.js',
				],
				'JobickAdminController_celandar' => [
					'vendor/fullcalendar-5.11.0/lib/main.js',
					'vendor/wow-master/dist/wow.min.js',
					'js/calendar-2.js',
				],
				'JobickAdminController_job_application' => [
					'vendor/datatables/js/jquery.dataTables.min.js',
					'js/plugins-init/datatables.init.js',
				],

				'JobickAdminController_app_calender' => [
					'vendor/moment/moment.min.js',
					'vendor/fullcalendar/js/main.min.js',
					'js/plugins-init/fullcalendar-init.js',
				],
				'JobickAdminController_content' => [
					'js/dashboard/cms.js',
					
				],
				'JobickAdminController_content_add' => [
					'js/dashboard/cms.js',
					'vendor/ckeditor/ckeditor.js',
					
				],
				'JobickAdminController_menu' => [
					'js/dashboard/cms.js',
					'vendor/nestable2/js/jquery.nestable.min.js',
					'js/plugins-init/nestable-init.js',
				],
				'JobickAdminController_email_template' => [
					'js/dashboard/cms.js',
				],
				'JobickAdminController_add_email' => [
					'js/dashboard/cms.js',
					'vendor/ckeditor/ckeditor.js',
				],
				'JobickAdminController_blog' => [
					'js/dashboard/cms.js',
				],
				'JobickAdminController_add_blog' => [
					'vendor/ckeditor/ckeditor.js',
					'vendor/select2/js/select2.full.min.js',
					'js/plugins-init/select2-init.js',
					'js/dashboard/cms.js',
				],
				'JobickAdminController_blog_category' => [
					'js/dashboard/cms.js',
					
				],
				
				'JobickAdminController_app_profile' => [
					'vendor/lightgallery/js/lightgallery-all.min.js',
					
				],
				'JobickAdminController_post_details' => [
					'vendor/lightgallery/js/lightgallery-all.min.js',
					
				],
				'JobickAdminController_chart_chartist' => [
					'vendor/apexchart/apexchart.js',
					'vendor/chartist/js/chartist.min.js',
					'vendor/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js',
					'js/plugins-init/chartist-init.js',
				],
				'JobickAdminController_chart_chartjs' => [
					'vendor/chartjs/chart.bundle.min.js',
					'js/plugins-init/chartjs-init.js',
				],
				'JobickAdminController_chart_flot' => [
					'vendor/flot/jquery.flot.js',
					'vendor/flot/jquery.flot.pie.js',
					'vendor/flot/jquery.flot.resize.js',
					'vendor/flot-spline/jquery.flot.spline.min.js',
					'js/plugins-init/flot-init.js',
					
				],
				'JobickAdminController_chart_morris' => [
					
					'vendor/apexchart/apexchart.js',
					'vendor/raphael/raphael.min.js',
					'vendor/morris/morris.min.js',
					'js/plugins-init/morris-init.js',
				],
				'JobickAdminController_chart_peity' => [
					'vendor/peity/jquery.peity.min.js',
					'js/plugins-init/piety-init.js',
				],
				'JobickAdminController_chart_sparkline' => [
					'vendor/apexchart/apexchart.js',
					'vendor/jquery-sparkline/jquery.sparkline.min.js',
					'js/plugins-init/sparkline-init.js',
				],
				'JobickAdminController_ecom_checkout' => [
				],
				'JobickAdminController_ecom_customers' => [
				],
				'JobickAdminController_ecom_invoice' => [

				],
				'JobickAdminController_ecom_product_detail' => [
					'vendor/star-rating/jquery.star-rating-svg.js',
					'vendor/owl-carousel/owl.carousel.js',
				],
				'JobickAdminController_ecom_product_grid' => [
				],
				'JobickAdminController_ecom_product_list' => [
					'vendor/star-rating/jquery.star-rating-svg.js'
				],
				'JobickAdminController_ecom_product_order' => [
				],
				'JobickAdminController_email_compose' => [
					'vendor/dropzone/dist/dropzone.js'
				],
				'JobickAdminController_email_inbox' => [
					
				],
				'JobickAdminController_email_read' => [
				],
				'JobickAdminController_form_ckeditor' => [
					'vendor/ckeditor/ckeditor.js',
				],
				'JobickAdminController_form_element' => [
				],
				'JobickAdminController_form_pickers' => [
					'vendor/moment/moment.min.js',
					'vendor/bootstrap-daterangepicker/daterangepicker.js',
					'vendor/clockpicker/js/bootstrap-clockpicker.min.js',
					'vendor/jquery-asColor/jquery-asColor.min.js',
					'vendor/jquery-asGradient/jquery-asGradient.min.js',
					'vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js',
					'vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
					'vendor/pickadate/picker.js',
					'vendor/pickadate/picker.time.js',
					'vendor/pickadate/picker.date.js',
					'js/plugins-init/bs-daterange-picker-init.js',
					'js/plugins-init/clock-picker-init.js',
					'js/plugins-init/jquery-asColorPicker.init.js',
					'js/plugins-init/material-date-picker-init.js',
					'js/plugins-init/pickadate-init.js',
				],
				'JobickAdminController_form_validation_jquery' => [
				],
				'JobickAdminController_form_wizard' => [
					'vendor/jquery-steps/build/jquery.steps.min.js',
					'js/plugins-init/jquery.validate-init.js',
					'vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js',
					
				],
				'JobickAdminController_map_jqvmap' => [
					'vendor/jqvmap/js/jquery.vmap.min.js',
					'vendor/jqvmap/js/jquery.vmap.world.js',
					'vendor/jqvmap/js/jquery.vmap.usa.js',
					'js/plugins-init/jqvmap-init.js',
				],
				'JobickAdminController_page_error_400' => [
				],
				'JobickAdminController_page_error_403' => [
				],
				'JobickAdminController_page_error_404' => [
				],
				'JobickAdminController_page_error_500' => [
				],
				'JobickAdminController_page_error_503' => [
				],
				'JobickAdminController_page_forgot_password' => [
				],
				'JobickAdminController_page_lock_screen' => [
					'vendor/deznav/deznav.min.js'
				],
				'JobickAdminController_page_login' => [
				],
				'JobickAdminController_page_register' => [
				],
				'JobickAdminController_table_bootstrap_basic' => [
					

				],
				'JobickAdminController_table_datatable_basic' => [
					'vendor/datatables/js/jquery.dataTables.min.js',
					'vendor/datatables/responsive/responsive.js',
					'js/plugins-init/datatables.init.js',
					
					
				],
				'JobickAdminController_edit_profile' => [
					'vendor/bootstrap-datepicker-master/js/bootstrap-datepicker.min.js',
					
				],
				'JobickAdminController_uc_lightgallery' => [
					'vendor/lightgallery/js/lightgallery-all.min.js',
				],
				'JobickAdminController_my_profile' => [
					'vendor/apexchart/apexchart.js',
					'js/dashboard/my-profile.js',
				],
				'JobickAdminController_uc_nestable' => [
					'vendor/nestable2/js/jquery.nestable.min.js',
					'js/plugins-init/nestable-init.js',
				],
				'JobickAdminController_uc_noui_slider' => [
					'vendor/nouislider/nouislider.min.js',
					'vendor/wnumb/wNumb.js',
					'js/plugins-init/nouislider-init.js',
				],
				'JobickAdminController_uc_select2' => [
					'vendor/select2/js/select2.full.min.js',
					'js/plugins-init/select2-init.js',
				],
				'JobickAdminController_uc_sweetalert' => [
					'vendor/sweetalert2/dist/sweetalert2.min.js',
					'js/plugins-init/sweetalert.init.js',
				],
				'JobickAdminController_uc_toastr' => [
					'vendor/toastr/js/toastr.min.js',
					'js/plugins-init/toastr-init.js',
				],
				'JobickAdminController_ui_accordion' => [
					
				],
				'JobickAdminController_ui_alert' => [
					
				],
				'JobickAdminController_ui_badge' => [
					
				],
				'JobickAdminController_ui_button' => [
					
				],
				'JobickAdminController_ui_button_group' => [
					
				],
				'JobickAdminController_ui_card' => [
					
				],
				'JobickAdminController_ui_carousel' => [
					
				],
				'JobickAdminController_ui_dropdown' => [
					
				],
				'JobickAdminController_ui_grid' => [
				],
				'JobickAdminController_ui_list_group' => [
					
				],
				'JobickAdminController_ui_media_object' => [
				],
				'JobickAdminController_ui_modal' => [
				],
				'JobickAdminController_ui_pagination' => [
					
				],
				'JobickAdminController_ui_popover' => [
				],
				'JobickAdminController_ui_progressbar' => [
					
				],
				'JobickAdminController_ui_tab' => [
					
				],
				'JobickAdminController_ui_typography' => [
				],
				'JobickAdminController_widget_card' => [
				],
				'JobickAdminController_widget_basic' => [
					'vendor/chartjs/chart.bundle.min.js',
					'vendor/apexchart/apexchart.js',
					'vendor/chartist/js/chartist.min.js',
					'vendor/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js',
					'vendor/flot/jquery.flot.js',
					'vendor/flot/jquery.flot.pie.js',
					'vendor/flot/jquery.flot.resize.js',
					'vendor/flot-spline/jquery.flot.spline.min.js',
					'vendor/jquery-sparkline/jquery.sparkline.min.js',
					'js/plugins-init/sparkline-init.js',
					'vendor/peity/jquery.peity.min.js',
					'js/plugins-init/piety-init.js',
					'js/plugins-init/widgets-script-init.js',
				],
				
				
			]
		],
	]
];
