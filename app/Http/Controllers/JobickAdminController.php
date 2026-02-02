<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobickAdminController extends Controller
{
	public $page_description;
	
    // Dashboard
    public function dashboard(){
        $page_title = 'Dashboard';
        $page_description = $this->page_description();
        return view('jobick.dashboard.index', compact('page_title', 'page_description'));
    }
	
	// Dashboard 2
	public function dashboard_2(){
        $page_title = 'Dashboard';
        $page_description = $this->page_description();
        return view('jobick.dashboard.index_2', compact('page_title', 'page_description'));
    }
	
	// order-list 
	
	public function jobs_page(){
        $page_title = 'Search Jobs';
        $page_description = $this->page_description();
        return view('jobick.dashboard.jobs_page', compact('page_title', 'page_description'));
    }
	
	// order-details 
	
	public function application_page(){
        $page_title = 'Applications';
        $page_description = $this->page_description();
        return view('jobick.dashboard.application_page', compact('page_title', 'page_description'));
    }
	// customer list
	
	public function my_profile(){
        $page_title = 'My Profile';
        $page_description = $this->page_description();
        return view('jobick.dashboard.my_profile', compact('page_title', 'page_description'));
    }

    // statistics Page
	public function job_list(){
        $page_title = 'Job List';
        $page_description = $this->page_description();
        return view('jobick.dashboard.job_list', compact('page_title', 'page_description'));
    }

    // Job view
	public function job_view(){
        $page_title = 'Job View';
        $page_description = $this->page_description();
        return view('jobick.dashboard.job_view', compact('page_title', 'page_description'));
    }
    // new  job
	public function new_job(){
        $page_title = 'New Job';
        $page_description = $this->page_description();
        return view('jobick.dashboard.new_job', compact('page_title', 'page_description'));
    }
    // statistics_page 
	public function statistics_page (){
        $page_title = 'Statistics';
        $page_description = $this->page_description();
        return view('jobick.dashboard.statistics_page ', compact('page_title', 'page_description'));
    }
    // compaines 
	public function companies(){
        $page_title = 'Companies';
        $page_description = $this->page_description();
        return view('jobick.dashboard.companies ', compact('page_title', 'page_description'));
    }
    // compaines 
	public function job_application(){
        $page_title = 'Job Application';
        $page_description = $this->page_description();
        return view('jobick.dashboard.job_application', compact('page_title', 'page_description'));
    }
    // apply_job 
	public function apply_job(){
        $page_title = 'Apply Job';
        $page_description = $this->page_description();
        return view('jobick.dashboard.apply_job', compact('page_title', 'page_description'));
    }
    // apply_job 
	public function user_profile(){
        $page_title = 'User Profile';
        $page_description = $this->page_description();
        return view('jobick.dashboard.user_profile', compact('page_title', 'page_description'));
    }
	
	// analytics 
	
	public function celandar(){
        $page_title = 'Celandar';
        $page_description = $this->page_description();
        return view('jobick.dashboard.celandar', compact('page_title', 'page_description'));
    }

    public function chat(){
        $page_title = 'Chat';
        $page_description = $this->page_description();
        return view('jobick.dashboard.chat', compact('page_title', 'page_description'));
    }
	
	// Reviews 
	
	public function activity(){
        $page_title = 'Activity';
        $page_description = $this->page_description();
        return view('jobick.dashboard.activity', compact('page_title', 'page_description'));
    }
	// app-calender 
	
	public function app_calender(){
        $page_title = 'Calender';
        $page_description = $this->page_description();
        return view('jobick.app.calender', compact('page_title', 'page_description'));
    }
	
	// app-profile-1
	
	public function app_profile(){
        $page_title = 'App Profile';
        $page_description = $this->page_description();
        return view('jobick.app.profile', compact('page_title', 'page_description'));
    }
	public function edit_profile(){
        $page_title = 'Edit Profile';
        $page_description = $this->page_description();
        return view('jobick.app.edit_profile', compact('page_title', 'page_description'));
    }
	
	// blog
	
	public function blog(){
        $page_title = 'Blog';
        $page_description = $this->page_description();
        return view('jobick.cms.blog', compact('page_title', 'page_description'));
    }
	
	// add catagery
	
	public function blog_category(){
        $page_title = 'Blog Category';
        $page_description = $this->page_description();
        return view('jobick.cms.blog_category', compact('page_title', 'page_description'));
    }
	
	// chart-chartist
	
	public function chart_chartist(){
        $page_title = 'Chart Chartlist';
        $page_description = $this->page_description();
        return view('jobick.chart.chartist', compact('page_title', 'page_description'));
    }
	
	// chart-chartjs
	
	public function chart_chartjs(){
        $page_title = 'Chart Chartjs';
        $page_description = $this->page_description();
        return view('jobick.chart.chartjs', compact('page_title', 'page_description'));
    }
	
	// chart-flot
	
	public function chart_flot(){
        $page_title = 'Chart Flot';
        $page_description = $this->page_description();
        return view('jobick.chart.flot', compact('page_title', 'page_description'));
    }
	
	// chart-morris
	
	public function chart_morris(){
        $page_title = 'Chart Morris';
        $page_description = $this->page_description();
        return view('jobick.chart.morris', compact('page_title', 'page_description'));
    }
	
	// chart-sparkline
	
	public function chart_sparkline(){
        $page_title = 'Chart Sparkline';
        $page_description = $this->page_description();
        return view('jobick.chart.sparkline', compact('page_title', 'page_description'));
    }
	
	
	// chart-peity
	
	public function chart_peity(){
        $page_title = 'Chart Peity';
        $page_description = $this->page_description();
        return view('jobick.chart.peity', compact('page_title', 'page_description'));
    }
	
	// Contant
	
	public function content(){
        $page_title = 'Content';
        $page_description = $this->page_description();
        return view('jobick.cms.content', compact('page_title', 'page_description'));
    }
	
	// Add content
	
	public function content_add(){
        $page_title = 'Add Content';
        $page_description = $this->page_description();
        return view('jobick.cms.content_add', compact('page_title', 'page_description'));
    }

	// add_email
	
	public function add_email(){
        $page_title = 'Add Email';
        $page_description = $this->page_description();
        return view('jobick.cms.add_email', compact('page_title', 'page_description'));
    }
	// add_email
	
	public function add_blog(){
        $page_title = 'Add Blog';
        $page_description = $this->page_description();
        return view('jobick.cms.add_blog ', compact('page_title', 'page_description'));
    }
	
	// ecom-checkout
	
	public function ecom_checkout(){
        $page_title = 'Ecom Checkout';
        $page_description = $this->page_description();
        return view('jobick.ecom.checkout', compact('page_title', 'page_description'));
    }
	
	// ecom-customers
	
	public function ecom_customers(){
        $page_title = 'Customers';
        $page_description = $this->page_description();
        return view('jobick.ecom.customers', compact('page_title', 'page_description'));
    }
	
	// ecom-invoice
	
	public function ecom_invoice(){
        $page_title = 'Invoice';
        $page_description = $this->page_description();
        return view('jobick.ecom.invoice', compact('page_title', 'page_description'));
    }
	
	// ecom-product-detail
	
	public function ecom_product_detail(){
        $page_title = 'Product Detai';
        $page_description = $this->page_description();
        return view('jobick.ecom.product_detail', compact('page_title', 'page_description'));
    }
	
	// ecom-product-grid
	
	public function ecom_product_grid(){
        $page_title = 'Product Grid';
        $page_description = $this->page_description();
        return view('jobick.ecom.product_grid', compact('page_title', 'page_description'));
    }
	
	// ecom-product-list
	
	public function ecom_product_list(){
        $page_title = 'Product List';
        $page_description = $this->page_description();
        return view('jobick.ecom.product_list', compact('page_title', 'page_description'));
    }
	
	// ecom-product-order
	
	public function ecom_product_order(){
        $page_title = 'Product Order';
        $page_description = $this->page_description();
        return view('jobick.ecom.product_order', compact('page_title', 'page_description'));
    }

	
	// email-compose
	
	public function email_compose(){
        $page_title = 'Email Compose';
        $page_description = $this->page_description();
        return view('jobick.message.compose', compact('page_title', 'page_description'));
    }
	
	//email-inbox
	
	public function email_inbox(){
        $page_title = 'Email Inbox';
        $page_description = $this->page_description();
        return view('jobick.message.inbox', compact('page_title', 'page_description'));
    }
	
	//email-read
	
	public function email_read(){
        $page_title = 'Email Read';
        $page_description = $this->page_description();
        return view('jobick.message.read', compact('page_title', 'page_description'));
    }
	
	//email-template
	
	public function email_template(){
        $page_title = 'Email Template';
        $page_description = $this->page_description();
        return view('jobick.cms.email_template', compact('page_title', 'page_description'));
    }
	
	//empty-page
	
	public function empty_page(){
        $page_title = 'Empty Page';
        $page_description = $this->page_description();
        return view('jobick.page.empty_page', compact('page_title', 'page_description'));
    }
	
	//Flat icon
	
	public function flat_icons(){
        $page_title = 'Flaticon Icons';
        $page_description = $this->page_description();
        return view('jobick.icon.flat_icons', compact('page_title', 'page_description'));
    }

    //feather icon
    public function feather(){
        $page_title = 'Feather Icons';
        $page_description = $this->page_description();
        return view('jobick.icon.feather', compact('page_title', 'page_description'));
    }
	
	//form-ckeditor
	
	public function form_ckeditor(){
        $page_title = 'Form Ckeditor';
        $page_description = $this->page_description();
        return view('jobick.form.ckeditor', compact('page_title', 'page_description'));
    }
	
	//form-summernote
	
	public function form_editor_summernote(){
        $page_title = 'Ckeditor';
        $page_description = $this->page_description();
        return view('jobick.form.editor_summernote', compact('page_title', 'page_description'));
    }
	
	//form-element
	
	public function form_element(){
        $page_title = 'Form Element';
        $page_description = $this->page_description();
        return view('jobick.form.element', compact('page_title', 'page_description'));
    }
	
	//form-pickers
	
	public function form_pickers(){
        $page_title = 'Form Pickers';
        $page_description = $this->page_description();
        return view('jobick.form.pickers', compact('page_title', 'page_description'));
    }
	
	//form-validation
	
	public function form_validation(){
        $page_title = 'Form validation';
        $page_description = $this->page_description();
        return view('jobick.form.validation', compact('page_title', 'page_description'));
    }
	
	//form-wizard
	
	public function login(){
        $page_title = 'Login';
        $page_description = $this->page_description();
        return view('jobick.page.login', compact('page_title', 'page_description'));
    }
	
	//login
	
	public function form_wizard(){
        $page_title = 'Form wizard';
        $page_description = $this->page_description();
        return view('jobick.form.wizard', compact('page_title', 'page_description'));
    }
	
	//menu
	
	public function menu(){
        $page_title = 'Menu';
        $page_description = $this->page_description();
        return view('jobick.cms.menu', compact('page_title', 'page_description'));
    }
	
	//ap-jqvmap
	
	public function map_jqvmap(){
        $page_title = 'Jqvmap';
        $page_description = $this->page_description();
        return view('jobick.map.jqvmap', compact('page_title', 'page_description'));
    }
	
	
	//page-error-400
	
	public function page_error_400(){
        $page_title = 'Page Error 400';
        $page_description = $this->page_description();
        return view('jobick.page.error_400', compact('page_title', 'page_description'));
    }
	
	//page-error-403
	
	public function page_error_403(){
        $page_title = 'Page Error 403';
        $page_description = $this->page_description();
        return view('jobick.page.error_403', compact('page_title', 'page_description'));
    }
	
	//page-error-404
	
	public function page_error_404(){
        $page_title = 'Page Error 404';
        $page_description = $this->page_description();
        return view('jobick.page.error_404', compact('page_title', 'page_description'));
    }
	
	//page-error-500
	
	public function page_error_500(){
        $page_title = 'Page Error 500';
        $page_description = $this->page_description();
        return view('jobick.page.error_500', compact('page_title', 'page_description'));
    }
	
	//page-error-503
	
	public function page_error_503(){
        $page_title = 'Page Error 503';
        $page_description = $this->page_description();
        return view('jobick.page.error_503', compact('page_title', 'page_description'));
    }
	
	//page-forgot-password
	
	public function page_forgot_password(){
        $page_title = 'Page Forgot Password';
        $page_description = $this->page_description();
        return view('jobick.page.forgot_password', compact('page_title', 'page_description'));
    }
	
	//page-lock-screen
	
	public function page_lock_screen(){
        $page_title = 'Page Lock Screen';
        $page_description = $this->page_description();
        return view('jobick.page.lock_screen', compact('page_title', 'page_description'));
    }
	
	//page-login
	
	public function page_login(){
        $page_title = 'Page Login';
        $page_description = $this->page_description();
        return view('jobick.page.login', compact('page_title', 'page_description'));
    }
	
	//page-register
	
	public function page_register(){
        $page_title = 'Page Register';
        $page_description = $this->page_description();
        return view('jobick.page.register', compact('page_title', 'page_description'));
    }
	
	//svg
	
	public function svg_icons(){
        $page_title = 'Svg Icons';
        $page_description = $this->page_description();
        return view('jobick.icon.svg_icons', compact('page_title', 'page_description'));
    }
	
	//svg icon
	
	public function post_details(){
        $page_title = 'Post Details';
        $page_description = $this->page_description();
        return view('jobick.app.post_details', compact('page_title', 'page_description'));
    }
	
	//table-bootstrap-basic
	public function table_bootstrap_basic(){
        $page_title = 'Bootstrap Basic';
        $page_description = $this->page_description();
        return view('jobick.table.bootstrap_basic', compact('page_title', 'page_description'));
    }
	
	//table-datatable-basic
	
	public function table_datatable_basic(){
        $page_title = 'Datatable Basic';
        $page_description = $this->page_description();
        return view('jobick.table.datatable_basic', compact('page_title', 'page_description'));
    }
	
	//uc-lightgallery
	
	public function uc_lightgallery(){
        $page_title = 'Light Gallery';
        $page_description = $this->page_description();
        return view('jobick.uc.lightgallery', compact('page_title', 'page_description'));
    }
	
	//uc-nestable
	
	public function uc_nestable(){
        $page_title = 'Nestable';
        $page_description = $this->page_description();
        return view('jobick.uc.nestable', compact('page_title', 'page_description'));
    }
	
	//uc-noui-slider
	
	public function uc_noui_slider(){
        $page_title = 'Noui Slider';
        $page_description = $this->page_description();
        return view('jobick.uc.noui_slider', compact('page_title', 'page_description'));
    }
	
	//uc-select2
	
	public function uc_select2(){
        $page_title = 'Select2';
        $page_description = $this->page_description();
        return view('jobick.uc.select2', compact('page_title', 'page_description'));
    }
	
	//uc-sweetalert
	
	public function uc_sweetalert(){
        $page_title = 'Sweet Alert';
        $page_description = $this->page_description();
        return view('jobick.uc.sweetalert', compact('page_title', 'page_description'));
    }
	
	//uc-toastr
	
	public function uc_toastr(){
        $page_title = 'Toastr';
        $page_description = $this->page_description();
        return view('jobick.uc.toastr', compact('page_title', 'page_description'));
    }
	
	//ui-accordion
	
	public function ui_accordion(){
        $page_title = 'Accordion';
        $page_description = $this->page_description();
        return view('jobick.ui.accordion', compact('page_title', 'page_description'));
    }
	
	//ui-alert
	
	public function ui_alert(){
        $page_title = 'Alert';
        $page_description = $this->page_description();
        return view('jobick.ui.alert', compact('page_title', 'page_description'));
    }
	
	//ui-badge
	
	public function ui_badge(){
        $page_title = 'Badge';
        $page_description = $this->page_description();
        return view('jobick.ui.badge', compact('page_title', 'page_description'));
    }
	
	//ui-button
	
	public function ui_button(){
        $page_title = 'Button';
        $page_description = $this->page_description();
        return view('jobick.ui.button', compact('page_title', 'page_description'));
    }
	
	//ui-button-group
	
	public function ui_button_group(){
        $page_title = 'Button';
        $page_description = $this->page_description();
        return view('jobick.ui.button_group', compact('page_title', 'page_description'));
    }
	
	//ui-button-group
	
	public function ui_card(){
        $page_title = 'Card';
        $page_description = $this->page_description();
        return view('jobick.ui.card', compact('page_title', 'page_description'));
    }
	
	//ui-carousel
	
	public function ui_carousel(){
        $page_title = 'Carousel';
        $page_description = $this->page_description();
        return view('jobick.ui.carousel', compact('page_title', 'page_description'));
    }
	
	//ui-dropdown
	
	public function ui_dropdown(){
        $page_title = 'Dropdown';
        $page_description = $this->page_description();
        return view('jobick.ui.dropdown', compact('page_title', 'page_description'));
    }
	
	//ui-grid
	
	public function ui_grid(){
        $page_title = 'Grid';
        $page_description = $this->page_description();
        return view('jobick.ui.grid', compact('page_title', 'page_description'));
    }
	
	//media object
	
	public function ui_media_object(){
        $page_title = 'Media Object';
        $page_description = $this->page_description();
        return view('jobick.ui.media_object', compact('page_title', 'page_description'));
    }
	
	//ui-list-group
	
	public function ui_list_group(){
        $page_title = 'List Group';
        $page_description = $this->page_description();
        return view('jobick.ui.list_group', compact('page_title', 'page_description'));
    }
	
	//ui-modal
	
	public function ui_modal(){
        $page_title = 'Modal';
        $page_description = $this->page_description();
        return view('jobick.ui.modal', compact('page_title', 'page_description'));
    }
	
	//ui-pagination
	
	public function ui_pagination(){
        $page_title = 'Pagination';
        $page_description = $this->page_description();
        return view('jobick.ui.pagination', compact('page_title', 'page_description'));
    }
	
	//ui-popover
	
	public function ui_popover(){
        $page_title = 'Popover';
        $page_description = $this->page_description();
        return view('jobick.ui.popover', compact('page_title', 'page_description'));
    }
	
	//ui-progressbar
	
	public function ui_progressbar(){
        $page_title = 'Progressbar';
        $page_description = $this->page_description();
        return view('jobick.ui.progressbar', compact('page_title', 'page_description'));
    }
	
	//ui-tab
	
	public function ui_tab(){
        $page_title = 'Tab';
        $page_description = $this->page_description();
        return view('jobick.ui.tab', compact('page_title', 'page_description'));
    }
	
	//ui-typography
	
	public function ui_typography(){
        $page_title = 'Tab';
        $page_description = $this->page_description();
        return view('jobick.ui.typography', compact('page_title', 'page_description'));
    }
	
	//widget-basic
	public function widget_basic(){
        $page_title = 'Widget';
        $page_description = $this->page_description();
        return view('jobick.widget.widget_basic', compact('page_title', 'page_description'));
    }
    //ajax_featuredcompanies
	public function ajax_featuredcompanies(){
        return view('jobick.ajax.featuredcompanies');
    }

    //seller_menus
	public function ajax_recentactivity(){
        return view('jobick.ajax.recentactivity');
    }

    
	
	//$page_description = $this->page_description();
	private function page_description() {
		return 'We proudly present Jobick, a Job Admin dashboard HTML Template, If you are hiring a job expert you would like to build a superb website for your Jobick, its a best choice.';
	}
	
	
}
