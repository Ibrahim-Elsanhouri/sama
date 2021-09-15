<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
	use Carbon\Carbon;
	use App\Models\Task; 
	use App\Models\Project; 
	use App\Traits\Notification; 

	class AdminTasksController extends \crocodicstudio\crudbooster\controllers\CBController {
		use Notification; 

	    public function cbInit() {
		//	$current_timestamp = Carbon::now(); 
		//	dd($current_timestamp); 

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "title";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "tasks";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"مرسلة من","name"=>"from","join"=>"cms_users,name"];
			$this->col[] = ["label"=>"مرسلة الى","name"=>"to","join"=>"cms_users,name"];
			$this->col[] = ["label"=>"المهمة","name"=>"works_id","join"=>"works,name"];
			$this->col[] = ["label"=>"العميل","name"=>"users_id","join"=>"users,name"];
			$this->col[] = ["label"=>"الجوال","name"=>"users_id","join"=>"users,mobile"];

			$this->col[] = ["label"=>"موقع المشروع","name"=>"projects_id","join"=>"projects,address"];

		//	$this->col[] = ["label"=>"موعد التسليم","name"=>"deadline"];
		    $this->col[] = ["label"=>"تاريخ المهمة","name"=>"created_at"];
			//$this->col[] = ["label"=>"Total Favorite","name"=>"($current_timestamp) as total_favorite"];

			$this->col[] = ["label"=>"تم الانجاز","name"=>"done"];
			$this->col[] = ["label"=>"تم التأكيد","name"=>"approved"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'الشخص المنفذ','name'=>'to','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'cms_users,name'];
			$this->form[] = ['label'=>'المشروع','name'=>'projects_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'projects,name'];
			$this->form[] = ['label'=>'المهمة','name'=>'works_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'works,name'];
			//$this->form[] = ['label'=>'التفاصيل','name'=>'description','type'=>'textarea','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
	//		$this->form[] = ['label'=>'موعد التسليم','name'=>'deadline','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'الشخص المنفذ','name'=>'to','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'cms_users,name'];
			//$this->form[] = ['label'=>'المشروع','name'=>'projects_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'projects,name'];
			//
			//$this->form[] = ['label'=>'المهمة','name'=>'title','type'=>'text','validation'=>'required|string|min:3|max:70','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'التفاصيل','name'=>'description','type'=>'wysiwyg','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10','placeholder'=>'فضلا ادخل احرف فقط'];
			//$this->form[] = ['label'=>'موعد التسليم','name'=>'deadline','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
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
			$this->sub_module[] = ['label'=>'ملاحظات و استفسارات','path'=>'notes',
			'parent_columns'=>'name','foreign_key'=>'tasks_id','button_color'=>'success',
			'button_icon'=>'fa fa-sticky-note-o'];


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
			$this->addaction[] = ['label'=>'تأكيد التنفيذ','url'=>CRUDBooster::mainpath('#'),'icon'=>'fa fa-cloud-download','color'=>'primary','showIf'=>"[done] == '0'"];
			$this->addaction[] = ['label'=>'تم التنفيذ','url'=>CRUDBooster::mainpath('#'),'icon'=>'fa fa-thumbs-up','color'=>'success','showIf'=>"[done] == '1'"];

			$this->addaction[] = ['label'=>'انهاء المهمة','url'=>CRUDBooster::mainpath('set-approved/1/[id]'),'icon'=>'fa fa-check','color'=>'primary','showIf'=>"[approved] == '0'"];
			$this->addaction[] = ['label'=>'تم الانهاء','url'=>CRUDBooster::mainpath('set-approved/1/[id]'),'icon'=>'fa fa-check-square-o','color'=>'success','showIf'=>"[approved] == '1'"];
	        $this->addaction[] = ['label'=>'جديد','url'=>CRUDBooster::mainpath('add'),'icon'=>'fa fa-book','color'=>'info'];

			
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

	//		$this->button_selected[] = ['label'=>'Set Active','icon'=>'fa fa-check','name'=>'set_active'];

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
			//$id_selected is an array of id 
			//$button_name is a name that you have set at button_selected 
			
	//		if($button_name == 'set_active') {
	//		  DB::table('products')->whereIn('id',$id_selected)->update(['status'=>'active']);
	//		}
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
			$postdata['from'] = CRUDBooster::myId();
			$postdata['users_id'] = Project::find($postdata['projects_id'])->user->id; 


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
			$project = Task::find($id)->project; 

		 if ($project->tasks->count() == 1){
			 $project->halas_id = 2; 
			 $project->save(); 
		 }; 


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
//			$data['row'] = DB::table('products')->where('id',$id)->first();
$task = Task::find($id);
return view('tasks.details' , compact('task', 'data'));
			
			//Please use view method instead view method from laravel
	//		return $this->view('custom_detail_view',$data);
		  }


	    //By the way, you can still create your own method in here... :) 

	//	public function getSetDone($done,$id) {
	//		DB::table('tasks')->where('id',$id)->update(['done'=>$done]);
			
			//This will redirect back and gives a message
	//		CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"تم تنفيذ المهمة 👍 ","info");
//		 }


		 public function getSetApproved($approved,$id) {
			if(CRUDBooster::myPrivilegeId() == 2){
				DB::table('tasks')->where('id',$id)->update(['approved'=>$approved ]);
			$to = Task::find($id)->to; 
		
			//This will redirect back and gives a message
			$this->validate_finish_task($to); 
			CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"تم تاكيد  التنفيذ 👍 ","info");	
			}
			CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"ليس لديك صلاحية انهاء مهمة","danger");	

		 }
		 


	}