<?php

use Illuminate\Database\Seeder;
use App\Board;
use App\Role;
use App\Permission;

class ChangeSomeFieldValuesInDatabase extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Chnaging Board Name 'Mumbai Board' To 'Mumbai'
        $board_id = Board::where('board_name', '=', "Mumbai Board")->value('id');
        if($board_id){
            $data = Board::findOrFail($board_id);
            $data->board_name ='Mumbai';
            $data->save();
        }

        // Changing  dashboard path of all REE offer letter users
        $ee_role_id = Role::where('name', '=', 'ee_engineer')->value('id');
        if($ee_role_id){
            $data = Role::findOrFail($ee_role_id);
            $data->dashboard ='/dashboard';
            $data->redirect_to ='/ee';
            $data->save();
        }


        $ee_dy_role_id = Role::where('name','ee_dy_engineer')->value('id');
        if($ee_dy_role_id){
            $data = Role::findOrFail($ee_dy_role_id);
            $data->dashboard ='/dashboard';
            $data->redirect_to ='/ee';
            $data->save();
        }


        $ee_jr_role_id = Role::where('name','ee_junior_engineer')->value('id');
        if($ee_jr_role_id){
            $data = Role::findOrFail($ee_jr_role_id);
            $data->dashboard ='/dashboard';
            $data->redirect_to ='/ee';
            $data->save();
        }

        $role_id = Role::where('name', '=', 'dyce_engineer')->value('id');
        if($role_id){
            $data = Role::findOrFail($role_id);
            $data->dashboard ='/dashboard';
            $data->redirect_to ='/dyce';
            $data->save();
        }


        $dyce_deputy_role_id = Role::where('name', '=', 'dyce_deputy_engineer')->value('id');
        if($dyce_deputy_role_id){
            $data = Role::findOrFail($dyce_deputy_role_id);
            $data->dashboard ='/dashboard';
            $data->redirect_to ='/dyce';
            $data->save();
        }

        $dyce_Jr_role_id = Role::where('name', '=', 'dyce_junior_engineer')->value('id');
        if($dyce_Jr_role_id){
            $data = Role::findOrFail($dyce_Jr_role_id);
            $data->dashboard ='/dashboard';
            $data->redirect_to ='/dyce';
            $data->save();
        }

        // Changing co and joint co dashboard path
        $joint_co_role_id = Role::where('name', '=', 'Joint CO')->value('id');
        if($joint_co_role_id ){
            $data = Role::findOrFail($joint_co_role_id);
            $data->dashboard ='/hearing-dashboard';
            $data->redirect_to ='/hearing';
            $data->save();
        }

        $joint_co_pa_role_id = Role::where('name','Joint Co PA')->value('id');
        if($joint_co_pa_role_id){
            $data = Role::findOrFail($joint_co_pa_role_id);
            $data->dashboard ='/hearing-dashboard';
            $data->redirect_to ='/hearing';
            $data->save();
        }

        $co_role_id = Role::where('name','Co')->value('id');
        if($co_role_id){
            $data = Role::findOrFail($co_role_id);
            $data->dashboard ='/hearing-dashboard';
            $data->redirect_to ='/hearing';
            $data->save();
        }

        $co_pa_role_id =Role::where('name','Co PA')->value('id');
        if($co_pa_role_id){
            $data = Role::findOrFail($co_pa_role_id);
            $data->dashboard ='/hearing-dashboard';
            $data->redirect_to ='/hearing';
            $data->save();
        }

        // Changing hearing dashboard route to 'hearing.dashboard' in permission

        $hearing_permission_id = Permission::where('name','hearing-dashboard')->value('id');
        if($hearing_permission_id){
            $data = Permission::findOrFail($hearing_permission_id);
            $data->name ='hearing.dashboard';
            $data->save();
        }

        //Appellate role
        $Rti_role_id =Role::where('name','RTI_Appellate')->value('id');
        if($Rti_role_id){
            $data = Role::findOrFail($Rti_role_id);
            $data->dashboard ='/rti-dashboard';
            $data->redirect_to ='/rti_applicants';
            $data->save();
        }
        //Rti role
        $Appellate_role_id =Role::where('name','RTI')->value('id');
        if($Appellate_role_id){
            $data = Role::findOrFail($Appellate_role_id);
            $data->dashboard ='/rti-dashboard';
            $data->redirect_to ='/rti_applicants';
            $data->save();
        }

        // Changing dashboard route of ree role to '/ree_dashboard'

        $ree_head_role_id = Role::where('name', '=', 'ree_engineer')->value('id');
        if($joint_co_role_id ){
            $data = Role::findOrFail($ree_head_role_id);
            $data->dashboard ='/ree_dashboard';
            $data->redirect_to ='/ree_applications';
            $data->save();
        }

        $ree_ass_role_id = Role::where('name', '=', 'REE Assistant Engineer')->value('id');
        if($ree_ass_role_id ){
            $data = Role::findOrFail($ree_ass_role_id);
            $data->dashboard ='/ree_dashboard';
            $data->redirect_to ='/ree_applications';
            $data->save();
        }

        $ree_dy_role_id = Role::where('name', '=', 'REE deputy Engineer')->value('id');
        if($ree_dy_role_id ){
            $data = Role::findOrFail($ree_dy_role_id);
            $data->dashboard ='/ree_dashboard';
            $data->redirect_to ='/ree_applications';
            $data->save();
        }

        $ree_jr_role_id = Role::where('name', '=', 'REE Junior Engineer')->value('id');
        if($ree_jr_role_id ){
            $data = Role::findOrFail($ree_jr_role_id);
            $data->dashboard ='/ree_dashboard';
            $data->redirect_to ='/ree_applications';
            $data->save();
        }

        // Changing dashboard route of CO role to '/co_dashboard'
        $co_role_id = Role::where('name', '=', 'co_engineer')->value('id');
        if($co_role_id ){
            $data = Role::findOrFail($co_role_id);
            $data->dashboard ='/co_dashboard';
            $data->save();
        }        

        // Changing redirect_to route of CO role to '/co'
        $co_role_id = Role::where('name', '=', 'co_engineer')->value('id');
        if($co_role_id ){
            $data = Role::findOrFail($co_role_id);
            $data->redirect_to ='/co';
            $data->save();
        }

        // Changing dashboard route of CAP to '/dashboard'
        $cap_role_id = Role::where('name', '=', 'cap_engineer')->value('id');
        if($cap_role_id ){
            $data = Role::findOrFail($cap_role_id);
            $data->dashboard ='/dashboard';
            $data->redirect_to ='/cap';
            $data->save();
        }

        // Changing dashboard route of VP to '/dashboard'
        $vp_role_id = Role::where('name', '=', 'vp_engineer')->value('id');
        if($vp_role_id ){
            $data = Role::findOrFail($vp_role_id);
            $data->dashboard ='/dashboard';
            $data->redirect_to ='/vp';
            $data->save();
        }

        // Changing dashboard routes
        //Account Role
        $account_role_id = Role::where('name', 'Account')->value('id');
        if ($account_role_id)
            Role::where('id',$account_role_id)->update(['dashboard' => '/search_accounts']);

        // SuperAdmin
        $super_admin_role_id = Role::where('name', 'superadmin')->value('id');
        if($super_admin_role_id)
            Role::where('id',$super_admin_role_id)->update(['dashboard' => '/crudadmin/dashboard']);

        // Appointing Architect
        $appointing_architect = Role::where('name', 'appointing_architect')->value('id');
        if($appointing_architect)
            Role::where('id',$appointing_architect)->update(['dashboard' => '/appointing_architect/index']);

        // Main Architect
        $architect_id = Role::where('name' , 'architect')->value('id');
        if($architect_id)
            Role::where('id',$architect_id)->update(['dashboard' => '/dashboard']);

        // Senior Architect
        $senior_architect = Role::where('name' , 'senior_architect')->value('id');
        if($senior_architect)
            Role::where('id',$senior_architect)->update(['dashboard' => '/dashboard']);


        // Junior Architect
        $junior_architect = Role::where('name' , 'junior_architect')->value('id');
        if($junior_architect)
            Role::where('id',$junior_architect)->update(['dashboard' => '/dashboard']);

        // Dyco
        $dyco = Role::where('name', 'dyco_engineer')->value('id');
        if($dyco)
            Role::where('id',$dyco)->update(['dashboard' => '/sc_dashboard']);

        // Dycdo
        $dycdo = Role::where('name' , 'dycdo_engineer')->value('id');
        if($dycdo)
            Role::where('id',$dycdo)->update(['dashboard' => '/sc_dashboard']);

        // EM Clerk
        $em_cl_role_id = Role::where('name','em_clerk')->value('id');
        if($em_cl_role_id)
            Role::where('id',$em_cl_role_id)->update(['dashboard' => '/em_clerk']);

        // EM Manager
        $em_manager_id = Role::where('name', '=', 'EM')->value('id');
        if($em_manager_id)
            Role::where('id',$em_manager_id)->update(['dashboard' => '/sc_dashboard']);

        // Land Manager
        $land_manager = Role::where('name', 'LM')->value('id');
        if($land_manager)
            Role::where('id',$land_manager)->update(['dashboard' => '/land_dashboard']);

        //RC
        $rc_collector = Role::where('name' , 'rc_collector')->value('id');
        if($rc_collector)
            Role::where('id',$rc_collector)->update(['dashboard' => '/rc']);


        // Resolution Manager
        $resolution_manager = Role::where('name', 'RM')->value('id');
        if($resolution_manager)
            Role::where('id',$resolution_manager)->update(['dashboard' => '/resolution']);

        // RTI Manager
        $rti_manager = Role::where('name', 'RTI')->value('id');
        if($rti_manager)
            Role::where('id',$rti_manager)->update(['dashboard' => '/rti-dashboard']);

        // Sap
        $sap = Role::where('name' , 'senior_architect_planner')->value('id');
        if($sap)
            Role::where('id',$sap)->update(['dashboard' => '/architect_layout_dashboard']);

        // Selection Commitee
        $slection_commitee = Role::where('name' ,'selection_commitee')->value('id');
        if($slection_commitee)
            Role::where('id',$slection_commitee)->update(['dashboard' => '/appointing_architect_dashboard']);

        // Society
        $society = Role::where('name', 'society')->value('id');
        if($society)
            Role::where('id',$society)->update(['dashboard' => '/society/society_offer_letter_dashboard']);

        // LA
        $la = Role::where('name', 'la_engineer')->value('id');
        if($la)
            Role::where('id',$la)->update(['dashboard' => '/sc_dashboard']);

        $master_layout_id = \App\MasterLayout::where([
            'layout_name' => 'Samata Nagar, Kandivali(E)',
            'Board' => 'Mumbai',
            'division' => 'Borivali',
        ])->value('id');

        if($master_layout_id){
            \App\MasterLayout::where([
                'layout_name' => 'Samata Nagar, Kandivali(E)',
                'Board' => 'Mumbai',
                'division' => 'Borivali',
            ])->delete();
        }

        // Removing department 1 from department
        $depaertment_id = \App\Department::where('department_name', 'Department 1')->value('id');

        if($depaertment_id){
            \App\Department::where([
                'department_name' => 'Department 1',
            ])->delete();

            \App\BoardDepartment::where('department_id',$depaertment_id)->delete();
        }

        // removing hearing co email and role
        $hearing_co = \App\User::where('email','hearingco@gmail.com')->value('id');
        if($hearing_co ){
            \App\User::where('email','hearingco@gmail.com')->delete();
        }

        $hearing_co_role = Role::where('name','Co')->value('id');
        if($hearing_co_role){
            Role::where('name','Co')->delete();
        }

        if($hearing_co_role){
            $hearing_user_role = \App\RoleUser::where('role_id',$hearing_co_role)->where('user_id',$hearing_co)->get();
            if($hearing_user_role){
                \App\RoleUser::where('role_id',$hearing_co_role)->where('user_id',$hearing_co)->delete();
            }
        }

        //update copa parent
        $copa = Role::where('name','Co PA')->value('id');

        $co = Role::where('name','co_engineer')->value('id');
        if($copa)
            Role::where('id',$copa)->update(['parent_id' => $co]);



        //removing offer letter document from noc cc
        $offer_letter_docs = \App\NocCCSocietyDocumentsMaster::where([
                    'name' => "Offer letter"
                ])->pluck('id');

        if($offer_letter_docs){
            \App\NocCCSocietyDocumentsMaster::where([
                'name' => "Offer letter"
            ])->delete();
        }

        //update tripartite doc name to 'Approved IOD / IOA'
        $tripartite_docs = \App\OlSocietyDocumentsMaster::where([
            'name' => "Approved NOC - IOD"
        ])->pluck('id');

        if($tripartite_docs){
            \App\OlSocietyDocumentsMaster::where('name' , "Approved NOC - IOD")->update(['name' => 'Approved IOD / IOA']);
        }

        //removing "Draft of triprtite agreement" doc from tripartite
        $tripartite_document = \App\OlSocietyDocumentsMaster::where([
            'name' => "Draft of triprtite agreement if available"
        ])->pluck('id');

        if($tripartite_document){
            \App\OlSocietyDocumentsMaster::where([
                'name' => "Draft of triprtite agreement if available"
            ])->delete();
        }

    }
}
