<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
	use App\Models\Project; 

	class AdminProjects23Controller extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {
	    	# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->table 			   = "projects";	        
			$this->title_field         = "name";
			$this->limit               = 20;
			$this->orderby             = "id,desc";
			$this->show_numbering      = FALSE;
			$this->global_privilege    = FALSE;	        
			$this->button_table_action = TRUE;   
			$this->button_action_style = "button_icon";     
			$this->button_add          = FALSE;
			$this->button_delete       = TRUE;
			$this->button_edit         = FALSE;
			$this->button_detail       = TRUE;
			$this->button_show         = TRUE;
			$this->button_filter       = TRUE;        
			$this->button_export       = FALSE;	        
			$this->button_import       = FALSE;
			$this->button_bulk_action  = TRUE;	
			$this->sidebar_mode		   = "normal"; //normal,mini,collapse,collapse-mini
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"رقم المشروع","name"=>"id"];
			$this->col[] = ["label"=>"اسم المشروع","name"=>"name"];
			$this->col[] = ["label"=>"نوع المشروع","name"=>"types_id","join"=>"types,name"];
			$this->col[] = ["label"=>"عنوان المشروع","name"=>"address"];

			$this->col[] = ["label"=>"المبلغ","name"=>"price"];
			$this->col[] = ["label"=>"رقم المعاملة","name"=>"process_number"];
			$this->col[] = ["label"=>"العميل","name"=>"users_id","join"=>"users,name"];
			$this->col[] = ["label"=>"الجوال","name"=>"users_id","join"=>"users,mobile"];
			$this->col[] = ["label"=>"حالة المشروع","name"=>"halas_id","join"=>"halas,name"];

			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'اسم المشروع','name'=>'name','type'=>'text','validation'=>'required|string|min:3|max:70','width'=>'col-sm-10','placeholder'=>'فضلا ادخل احرف فقط'];
			$this->form[] = ['label'=>'العنوان','name'=>'address','type'=>'text','validation'=>'string|min:3|max:70','width'=>'col-sm-10','placeholder'=>'فضلا ادخل احرف فقط'];

			$this->form[] = ['label'=>'نوع المشروع','name'=>'types_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'types,name'];
			$this->form[] = ['label'=>'المبلغ','name'=>'price','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'الدفعات','name'=>'payment','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'رقم المعاملة','name'=>'process_number','type'=>'text','validation'=>'min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'العميل','name'=>'users_id','type'=>'select2','validation'=>'required','width'=>'col-sm-9','datatable'=>'users,name'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Name","name"=>"name","type"=>"text","required"=>TRUE,"validation"=>"required|string|min:3|max:70","placeholder"=>"فضلا ادخل احرف فقط"];
			//$this->form[] = ["label"=>"Price","name"=>"price","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Payment","name"=>"payment","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Process Number","name"=>"process_number","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Types Id","name"=>"types_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"types,name"];
			//$this->form[] = ["label"=>"Users Id","name"=>"users_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"users,name"];
			//$this->form[] = ["label"=>"Halas Id","name"=>"halas_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"halas,name"];
			# OLD END FORM

			/* 
	        | ---------------------------------------------------------------------- 
	        | Sub Module
	        | ----------------------------------------------------------------------     
			| @label          = Label of action 
			| @path           = Path of sub module
			| @foreign_key 	  = foreign key of sub table/module
			| @button_color   = Bootstrap Class (primary,success,warning,danger)
			| @button_icon    = Font Awesome Class  
			| @parent_columns = Sparate with comma, e.g : name,created_at
	        | 
	        */
	        $this->sub_module = array();
			$this->sub_module[] = ['label'=>'مهام المشروع','path'=>'tasks','parent_columns'=>'id','foreign_key'=>'projects_id','button_color'=>'info','button_icon'=>'fa fa-book'];
			$this->sub_module[] = ['label'=>'المدفوعات','path'=>'payments','parent_columns'=>'id,price','foreign_key'=>'projects_id','button_color'=>'primary','button_icon'=>'fa fa-money'];
			$this->sub_module[] = 
			['label'=>'الملاحظات','path'=>'pnotes',
			'parent_columns'=>'id',
			'foreign_key'=>'projects_id',
			'button_color'=>'success','button_icon'=>'fa fa-book'];

	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Action Button / Menu
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
	        | @icon        = Font awesome class icon. e.g : fa fa-bars
	        | @color 	   = Default is primary. (primary, warning, succecss, info)     
	        | @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
	        | 
	        */
	        $this->addaction = array();


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Button Selected
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @icon 	   = Icon from fontawesome
	        | @name 	   = Name of button 
	        | Then about the action, you should code at actionButtonSelected method 
	        | 
	        */
	        $this->button_selected = array();

	                
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add alert message to this module at overheader
	        | ----------------------------------------------------------------------     
	        | @message = Text of message 
	        | @type    = warning,success,danger,info        
	        | 
	        */
	        $this->alert        = array();
	                

	        
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add more button to header button 
	        | ----------------------------------------------------------------------     
	        | @label = Name of button 
	        | @url   = URL Target
	        | @icon  = Icon from Awesome.
	        | 
	        */
	        $this->index_button = array();



	        /* 
	        | ---------------------------------------------------------------------- 
	        | Customize Table Row Color
	        | ----------------------------------------------------------------------     
	        | @condition = If condition. You may use field alias. E.g : [id] == 1
	        | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.        
	        | 
	        */
	        $this->table_row_color = array();     	          

	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | You may use this bellow array to add statistic at dashboard 
	        | ---------------------------------------------------------------------- 
	        | @label, @count, @icon, @color 
	        |
	        */
	        $this->index_statistic = array();



	        /*
	        | ---------------------------------------------------------------------- 
	        | Add javascript at body 
	        | ---------------------------------------------------------------------- 
	        | javascript code in the variable 
	        | $this->script_js = "function() { ... }";
	        |
	        */
	        $this->script_js = NULL;


            /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code before index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it before index table
	        | $this->pre_index_html = "<p>test</p>";
	        |
	        */
	        $this->pre_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code after index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it after index table
	        | $this->post_index_html = "<p>test</p>";
	        |
	        */
	        $this->post_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include Javascript File 
	        | ---------------------------------------------------------------------- 
	        | URL of your javascript each array 
	        | $this->load_js[] = asset("myfile.js");
	        |
	        */
	        $this->load_js = array();
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Add css style at body 
	        | ---------------------------------------------------------------------- 
	        | css code in the variable 
	        | $this->style_css = ".style{....}";
	        |
	        */
	        $this->style_css = NULL;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include css File 
	        | ---------------------------------------------------------------------- 
	        | URL of your css each array 
	        | $this->load_css[] = asset("myfile.css");
	        |
	        */
	        $this->load_css = array();
	        
	        
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for button selected
	    | ---------------------------------------------------------------------- 
	    | @id_selected = the id selected
	    | @button_name = the name of button
	    |
	    */
	    public function actionButtonSelected($id_selected,$button_name) {
	        //Your code here
	            
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate query of index result 
	    | ---------------------------------------------------------------------- 
	    | @query = current sql query 
	    |
	    */
	    public function hook_query_index(&$query) {
	        //Your code here
			$query->where('halas_id',1);

	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
	    	//Your code here
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before add data is execute
	    | ---------------------------------------------------------------------- 
	    | @arr
	    |
	    */
	    public function hook_before_add(&$postdata) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	    public function hook_after_add($id) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before update data is execute
	    | ---------------------------------------------------------------------- 
	    | @postdata = input post data 
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_edit(&$postdata,$id) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_edit($id) {
	        //Your code here 

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command before delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_delete($id) {
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_delete($id) {
	        //Your code here

	    }
		public function getDetail($id) {
			//Create an Auth
			if(!CRUDBooster::isRead() && $this->global_privilege==FALSE || $this->button_edit==FALSE) {    
			  CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
			}
			
		$data = [];
			$data['page_title'] = 'Detail Data';
	//	$data['row'] = DB::table('products')->where('id',$id)->first();
    $project = Project::find($id); 
			
			//Please use view method instead view method from laravel
	//		return $this->view('custom_detail_view',$data);
	return view('projects.detail' , compact('data', 'project'));
		  }


	    //By the way, you can still create your own method in here... :) 


	}