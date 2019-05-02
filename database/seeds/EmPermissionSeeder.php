<?php

use App\Permission;
use App\PermissionRole;
use App\Role;
use App\RoleUser;
use App\User;
use Illuminate\Database\Seeder;

class EmPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // EM Manager
        $em_manager_id = Role::where('name', '=', 'EM')->value('id');

        if ($em_manager_id == NULL)
            $em_manager_id = Role::insertGetId([
                'name' => 'EM',
                'redirect_to' => '/conveyance',
                'dashboard' => '/sc_dashboard',
                'display_name' => 'estate_manager',
                'description' => 'Login as Estae Manger',
            ]);

        // EM User
        $em_user_id = User::where(['email' => 'em@gmail.com'])->value('id');

        if ($em_user_id == NULL )
            $em_user_id = User::insertGetId([
                'name' => 'estate manager',
                'email' => 'em@gmail.com',
                'password' => bcrypt('1234'),
                'role_id' => $em_manager_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '8785854587',
                'address' => 'Mumbai',
            ]);

        // EM User and EM Manager Role Mapping
        $em_manager_role_user = RoleUser::where(['user_id' => $em_user_id, 'role_id' => $em_manager_id])->first();

        if($em_manager_role_user == NULL)
            RoleUser::insert([
                'user_id' => $em_user_id,
                'role_id' => $em_manager_id,
                'start_date' => \Carbon\Carbon::now()
            ]);

        // EM Manager Permissions
        $permissions = [
            [
                'name'=>'architect_layout_dashboard',
                'display_name' => 'Dashboard for Architect',
                'description' => 'Dashboard for Architect'
            ],
            [
                'name'=>'scrutiny-remark',
                'display_name'=>'list'
            ],
            [
                'name' => 'architect_layout.index',
                'display_name' => 'List layouts',
                'description' => 'Listing of architect layouts',
            ],
            [
                'name' => 'architect_layouts_layout_details.index',
                'display_name' => 'architect_layouts_layout_details.index',
                'description' => 'architect_layouts_layout_details.index',
            ],
            [
                'name' => 'architect_layout_details.view',
                'display_name' => 'architect_layout_details.view',
                'description' => 'architect_layout_details.view',
            ],
            [
                'name' => 'architect_layout_detail_view_cts_plan',
                'display_name' => 'architect_layout_detail_view_cts_plan',
                'description' => 'architect_layout_detail_view_cts_plan',
            ],
            [
                'name' => 'architect_layout_detail_view_prc_detail',
                'display_name' => 'architect_layout_detail_view_prc_detail',
                'description' => 'architect_layout_detail_view_prc_detail',
            ],
            [
                'name' => 'architect_detail_dp_crz_remark_view',
                'display_name' => 'architect_detail_dp_crz_remark_view',
                'description' => 'architect_detail_dp_crz_remark_view',
            ],
            [
                'name' => 'view_court_case_or_dispute_on_land',
                'display_name' => 'view_court_case_or_dispute_on_land',
                'description' => 'view_court_case_or_dispute_on_land',
            ],
            [
                'name' => 'forward_architect_layout',
                'display_name' => 'forward_architect_layout',
                'description' => 'forward_architect_layout',
            ],
            [
                'name' => 'post_forward_architect_layout',
                'display_name' => 'post_forward_architect_layout',
                'description' => 'post_forward_architect_layout',
            ],
            [
                'name' => 'architect_layout_get_scrtiny',
                'display_name' => 'architect_layout_get_scrtiny',
                'description' => 'architect_layout_get_scrtiny',
            ],
            [
                'name' => 'architect_layout_add_scrutiny_report',
                'display_name' => 'architect_layout_add_scrutiny_report',
                'description' => 'architect_layout_add_scrutiny_report',
            ],
            [
                'name' => 'architect_layout_post_scrutiny_report',
                'display_name' => 'architect_layout_post_scrutiny_report',
                'description' => 'architect_layout_post_scrutiny_report',
            ],
            [
                'name'=>'delete_architect_layout_scrutiny_report',
                'display_name'=>'delete_architect_layout_scrutiny_report',
                'description'=>'delete_architect_layout_scrutiny_report'
            ],
            [
                'name' => 'upload_em_checklist_and_remark_report',
                'display_name' => 'upload_em_checklist_and_remark_report',
                'description' => 'upload_em_checklist_and_remark_report',
            ],
            [
                'name' => 'post_em_checklist_and_remark_report',
                'display_name' => 'post_em_checklist_and_remark_report',
                'description' => 'post_em_checklist_and_remark_report',
            ],
            [
                'name'         => 'conveyance.index',
                'display_name' => 'conveyance',
                'description'  => 'conveyance'
            ],
            [
                'name'         => 'conveyance.view_application',
                'display_name' => 'conveyance application',
                'description'  => 'conveyance application'
            ],
            [
                'name'         => 'em.scrutiny_remark',
                'display_name' => 'em scrutiny remark',
                'description'  => 'em scrutiny remark'
            ],
            [
                'name'         => 'em.save_renewal_no_dues_certificate',
                'display_name' => 'em save renewal no dues certificate',
                'description'  => 'em save renewal no dues certificate'
            ],
            [
                'name'         => 'em.upload_covering_letter',
                'display_name' => 'em upload covering letter',
                'description'  => 'em upload covering letter'
            ],
            [
                'name' => 'em.index',
                'display_name' => 'List EM Application',
                'description' => 'Listing EM Application'
            ],
            [
                'name' => 'get_societies',
                'display_name' => 'List Societies',
                'description' => 'Listing Societies'
            ],
            [
                'name' => 'get_buildings',
                'display_name' => 'List Buildings',
                'description' => 'Listing Buildings'
            ],
            [
                'name' => 'get_tenants',
                'display_name' => 'List Tenants',
                'description' => 'Listing Tenants'
            ],
            [
                'name' => 'soc_bill_level',
                'display_name' => 'Society bill level',
                'description' => 'Society bill level'
            ],
            [
                'name' => 'update_soc_bill_level',
                'display_name' => 'Update Society Bill Level',
                'description' => 'Update Society Bill Level'
            ],
            [
                'name' => 'soc_ward_colony',
                'display_name' => 'Society Ward Colony',
                'description' => 'Society Ward Colony'
            ],
            [
                'name' => 'update_soc_ward_colony',
                'display_name' => 'Update Society Ward Colony',
                'description' => 'Update Society Ward Colony'
            ],
            [
                'name' => 'get_wards',
                'display_name' => 'Get Wards',
                'description' => 'Get Wards'
            ],
            [
                'name' => 'get_colonies',
                'display_name' => 'Get Colonies',
                'description' => 'Get Colonies'
            ],
            [
                'name' => 'get_society_select',
                'display_name' => 'Selected Society',
                'description' => 'Selected Society'
            ],
            [
                'name' => 'get_building_ajax',
                'display_name' => 'Ajax building',
                'description' => 'Ajax building'
            ],
            [
                'name' => 'get_building_select',
                'display_name' => 'Selected Building',
                'description' => 'Selected Building'
            ],
            [
                'name' => 'get_tenant_ajax',
                'display_name' => 'Ajax Tenant',
                'description' => 'Ajax Tenant'
            ],
            [
                'name' => 'add_building',
                'display_name' => 'Add Building',
                'description' => 'Add Building'
            ],
            [
                'name' => 'edit_building',
                'display_name' => 'Edir Building Data',
                'description' => 'Edir Building Data'
            ],
            [
                'name' => 'create_building',
                'display_name' => 'Create Building',
                'description' => 'Create Building'
            ],
            [
                'name' => 'update_building',
                'display_name' => 'Update Building',
                'description' => 'Update Building'
            ],
            [
                'name' => 'add_tenant',
                'display_name' => 'Add Tenant',
                'description' => 'Add Tenant'
            ],
            [
                'name' => 'edit_tenant',
                'display_name' => 'Edit Tenant',
                'description' => 'Edit Tenant'
            ],
            [
                'name' => 'create_tenant',
                'display_name' => 'Create Tenant',
                'description' => 'Create Tenant'
            ],
            [
                'name' => 'update_tenant',
                'display_name' => 'Update Tenant',
                'description' => 'Update Tenant'
            ],
            [
                'name' => 'delete_tenant',
                'display_name' => 'Delete Tenant',
                'description' => 'Delete Tenant'
            ],
            [
                'name' => 'generate_soc_bill',
                'display_name' => 'Generate Society Bill',
                'description' => 'Generate Society Bill'
            ],
            [
                'name' => 'generate_tenant_bill',
                'display_name' => 'Generate Tenant Bill',
                'description' => 'Generate Tenant Bill'
            ],
            [
                'name' => 'arrears_calculations',
                'display_name' => 'Arrears Calculations',
                'description' => 'Arrears Calculationst'
            ],
            [
                'name' => 'billing_calculations',
                'display_name' => 'Biiling Calculations',
                'description' => 'Biiling Calculations'
            ],
            [
                'name' => 'generateTenantBill',
                'display_name' => 'Generate Tenant Bill',
                'description' => 'Generate Tenant Bill'
            ],
            [
                'name' => 'generateBuildingBill',
                'display_name' => 'Generate Building Bill',
                'description' => 'Generate Building Bill'
            ],
            [
                'name' => 'create_tenant_bill',
                'display_name' => 'Create Tenant Bill',
                'description' => 'Create Tenant Bill'
            ],
            [
                'name' => 'create_society_bill',
                'display_name' => 'Create Building Bill',
                'description' => 'Create Building Bill'
            ],
            [
                'name' => 'conveyance.view_documents',
                'display_name' => 'View Documents',
                'description' => 'View Documents Submitted'
            ],
            [
                'name' => 'em.save_conveyance_no_dues_certificate',
                'display_name' => 'Save no dues certificate',
                'description' => 'Saves no dues certificate'
            ],
            [
                'name' => 'conveyance.forward_application_sc',
                'display_name' => 'Forward Application',
                'description' => 'Forwards conveyance Application'
            ],
            [
                'name' => 'conveyance.save_forward_application',
                'display_name' => 'Saves Forward Application',
                'description' => 'Saves Forwards conveyance Application'
            ],
            [
                'name' => 'get_building_select_updated',
                'display_name' => 'Selected Building',
                'description' => 'Selected Building'
            ],  
            [
                'name'=>'get_sf_applications.index',
                'display_name'=>'Display list of society formation application',
                'description'=>'Display list of society formation application'
            ],
            [
                'name'=>'formation.view_application',
                'display_name'=>'View Application Submitted By society',
                'description'=>'View Application Submitted By society'
            ],
            [
                'name'=>'formation.forward_application',
                'display_name'=>'dipaly Page for Forward SF application',
                'description'=>'dipaly Page for Forward SF application'
            ],
            [
                'name'=>'formation.post_forward_application',
                'display_name'=>'post Forward SF application',
                'description'=>'post Forward SF application'
            ],
            [
                'name'=>'formation.em_srutiny_and_remark',
                'display_name'=>'display the scrutiny report of EM for SF',
                'description'=>'display the scrutiny report of EM for SF'
            ],
            [
                'name'=>'formation.post_em_srutiny_and_remark',
                'display_name'=>'post scutiny and remark history',
                'description'=>'post scutiny and remark history'
            ],
            [
                'name'=>'formation.upload_em_scrutiny_document_for_sf',
                'display_name'=>'upload em scrutinty doc file for SF application',
                'description'=>'upload em scrutinty doc file for SF application'
            ],
            [
                'name'=>'formation.get_no_dues_certificate',
                'display_name'=>'Display ck editor for no dues certificate',
                'description'=>'Display ck editor for no dues certificate'
            ],
            [
                'name'=>'formation.post_no_dues_certificate',
                'display_name'=>'post changes of ck editor for no dues certificate',
                'description'=>'post changes of  for no dues certificate'
            ],
            [
                'name'=>'formation.society_documents',
                'display_name'=>'View Documents UPloaded by society',
                'description'=>'View Documents UPloaded by society'
            ],
            [
                'name'=>'formation.send_no_due_to_society',
                'display_name'=>'No due Certiciate send to society',
                'description'=>'No due Certiciate send to society'
            ],
            [
                'name'=>'em.save_list_of_allottees',
                'display_name'=>'Upload list of allottees',
                'description'=>'Uploads list of allottees'
            ],
            [
                'name'=>'renewal.index',
                'display_name'=>'List of Applications for Renewal',
                'description'=>'Shows Lists of Applications for Renewal'
            ],
            [
                'name'=>'renewal.show',
                'display_name'=>'View Application',
                'description'=>'View Application in pdf format.'
            ],
            [
                'name'=>'renewal.view_application',
                'display_name'=>'View Application',
                'description'=>'View Application in pdf format.'
            ],
            [
                'name'=>'renewal.view_documents',
                'display_name'=>'View Society Documents',
                'description'=>'View Society Documents.'
            ],
            [
                'name'=>'em.renewal_scrutiny_remark',
                'display_name'=>'Scrutiny & Remarks',
                'description'=>'Scrutiny & Remarks'
            ],
            [
                'name'=>'renewal.save_forward_application_renewal',
                'display_name'=>'Forward Application',
                'description'=>'Forwards Application'
            ],
            [
                'name'=>'renewal.architect_scrutiny',
                'display_name'=>'Architect Srutiny & Remark',
                'description'=>'Architect Srutiny & Remark'
            ],
            [
                'name'=>'renewal.renewal_forward_application',
                'display_name'=>'Forward Application',
                'description'=>'Forward Application'
            ],
            [
                'name'=>'em.save_covering_letter',
                'display_name'=>'Uploads covering letter',
                'description'=>'Uploads covering letter'
            ],
            [
                'name' => 'downloadBill',
                'display_name' => 'Download Bill Building',
                'description' => 'Download Bill Building',
            ],
            [
                'name' => 'downloadReceipt',
                'display_name' => 'Download Receipt',
                'description' => 'Download Receipt',
            ],
            [
                'name'=>'conveyance.dashboard',
                'display_name'=>'conveyance dashboard',
                'description'=>'conveyance dashboard'
            ],
            [
                'name'=>'em.upload_renewal_covering_letter',
                'display_name'=>'Upload Covering Letter',
                'description'=>'Upload Covering Letter'
            ],
            [
                'name'=>'em.save_renewal_list_of_allottees',
                'display_name'=>'Uploads List of Bonafide Allottees',
                'description'=>'Uploads List of Bonafide Allottees'
            ],
            [
                'name' => 'admin.profile',
                'display_name' => 'Profile',
                'description'  => 'Updates user profile'
            ],
            [
                'name' => 'admin.update_profile',
                'display_name' => 'Updates user profile',
                'description'  => 'Updates user profile'
            ],
            [
                'name' => 'em.download_list_of_allottees',
                'display_name' => 'Download list of Allottees',
                'description'  => 'Download list of Allottees'
            ],
[
                'name' => 'dashboard.ajax.conveyance',
                'display_name' => 'Ajax EM dashboard',
                'description'  => 'Ajax EM dashboard'
            ],
            [
                'name'=>'estate-conveyance.period_wise_pendency_report',
                'display_name'=>'estate-conveyance.period_wise_pendency_report',
                'description'=>'estate-conveyance.period_wise_pendency_report'
            ],
            [
                'name'=>'estate_conveyance_pending_reports',
                'display_name'=>'redevelopement_pending_reports',
                'description'=>'redevelopement_pending_reports'
            ],
            [
                'name'=>'architect.period_wise_pendency_report',
                'display_name'=>'architect.period_wise_pendency_report',
                'description'=>'architect.period_wise_pendency_report'
            ],
            [
                'name'=>'architect_pending_reports',
                'display_name'=>'architect_pending_reports',
                'description'=>'architect_pending_reports'
            ],
            [
                'name'=>'scrutiny_report_by_em',
                'display_name'=>'scrutiny_report_by_em',
                'description'=>'scrutiny_report_by_em'
            ],
            
        ];

        $permission_role = [];

        foreach ($permissions as $lm_per) {
            $permission_id = Permission::where(['name' => $lm_per['name']])->value('id');

            if (!($permission_id))
                $permission_id = Permission::insertGetId($lm_per);

            $PermissionRole = PermissionRole::where(['permission_id' => $permission_id, 'role_id' => $em_manager_id])->first();

            if (!$PermissionRole) {
                $permission_role[] = [
                    'permission_id' => $permission_id,
                    'role_id' => $em_manager_id,
                ];
            }

        }
        
        if (count($permission_role) > 0) {
            PermissionRole::insert($permission_role);
        }

        $layout_id = \App\MasterLayout::where("layout_name", '=', "Samata Nagar, Kandivali(E)")->value('id');
        $layout_user =  \App\LayoutUser::where('user_id',$em_user_id)->where('layout_id',$layout_id)->first();

        if(!$layout_user){
            \App\LayoutUser::insert(['user_id' => $em_user_id, 'layout_id' => $layout_id]);
        }


        // EM Clerk
        $em_cl_role_id = Role::where('name','em_clerk')->value('id');

        if($em_cl_role_id  == NULL)
            $em_cl_role_id = Role::insertGetId([
                'name' => 'em_clerk',
                'redirect_to' => '/em_clerk',
                'dashboard' => '/em_clerk',
                'parent_id' => $em_manager_id,
                'display_name' => 'EM Clerk',
                'description' => 'EM Clerk'
            ]);

        // EM Clerk User
        $em_cl_user_id = User::where(['email' => 'em_clerk@gmail.com'])->value('id');

        if ($em_cl_user_id == NULL)
            $em_cl_user_id = User::insertGetId([
                'name' => 'Em Clerk',
                'email' => 'em_clerk@gmail.com',
                'password' => bcrypt('user123'),
                'role_id' => $em_cl_role_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '7412589635',
                'address' => 'Mumbai'
            ]);

        // EM Clerk User and EM Clerk Role Mapping
        $em_cl_role_user = RoleUser::where(['user_id' => $em_cl_user_id, 'role_id' => $em_cl_role_id])->first();

        if($em_cl_role_user == NULL)
            RoleUser::insert([
                'user_id' => $em_cl_user_id,
                'role_id' => $em_cl_role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);

        // EM Clerk Permission
        $em_clerk_permissions = [
            [
                'name' => 'em_clerk.index',
                'display_name' => 'List EM  ClerkApplication',
                'description' => 'Listing EM Clerk Application'
            ],
            [
                'name' => 'em_society_list',
                'display_name' => 'List EM  Society',
                'description' => 'Listing EM Society'
            ],
            [
                'name' => 'em_building_list',
                'display_name' => 'List EM  Building',
                'description' => 'Listing EM Building'
            ],
            [
                'name' => 'tenant_payment_list',
                'display_name' => 'List Tenant Payment',
                'description' => 'Listing Tenant Payment'
            ],
            [
                'name' => 'tenant_arrear_calculation',
                'display_name' => 'Tenant Arrear Calculation',
                'description' => 'Tenant Arrear Calculation'
            ],
            [
                'name' => 'create_arrear_calculation',
                'display_name' => 'Create Arrear Calculation',
                'description' => 'Create Arrear Calculation'
            ],
            [
                'name' => 'get_arrear_charges',
                'display_name' => 'Get Arrear Calculation',
                'description' => 'Get Arrear Calculation'
            ],
            [
                'name' => 'get_arrear_charges_multiple',
                'display_name' => 'Get Arrear Calculations',
                'description' => 'Get Arrear Calculations'
            ],
        ];

        $em_clerk_permission_role = [];

        foreach ($em_clerk_permissions as $em_clerk) {
            $em_clerk_permission_id = Permission::where(['name' => $em_clerk['name']])->value('id');
            if ($em_clerk_permission_id == NULL) {
                $em_clerk_permission_id = Permission::insertGetId($em_clerk);
            }

            $PermissionRole = PermissionRole::where(['permission_id' => $em_clerk_permission_id, 'role_id' => $em_cl_role_id])->first();
            if (!$PermissionRole) {
                $em_clerk_permission_role[] = [
                    'permission_id' => $em_clerk_permission_id,
                    'role_id' => $em_cl_role_id,
                ];
            }

        }
        if (count($em_clerk_permission_role) > 0) {
            PermissionRole::insert($em_clerk_permission_role);
        }
        $layout_id = \App\MasterLayout::where("layout_name", '=', "Samata Nagar, Kandivali(E)")->value('id');
        $layout_user =  \App\LayoutUser::where('user_id',$em_cl_user_id)->where('layout_id',$layout_id)->first();

        if(!$layout_user){
            \App\LayoutUser::insert(['user_id' => $em_cl_user_id, 'layout_id' => $layout_id]);
        }

        // change redirect to for EM to dashboard
        Role::where('id',$em_manager_id)->update(['redirect_to' => '/conveyance']);        
    }
}
