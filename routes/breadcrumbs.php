<?php

// Rti Application
Breadcrumbs::for('rti_applicants', function ($trail) {
    $trail->push('RTI Applicants', route('rti_applicants'));
});

Breadcrumbs::for('view_applicant', function ($trail,$id) {
    $trail->parent('rti_applicants');
    $trail->push('View Application', route('view_applicant',$id));
});

Breadcrumbs::for('schedule_meeting', function ($trail,$id) {
    $trail->parent('rti_applicants');
    $trail->push('Schedule Meeting', route('schedule_meeting',$id));
});

Breadcrumbs::for('update_status', function ($trail,$id) {
    $trail->parent('rti_applicants');
    $trail->push('Update Status', route('update_status',$id));
});

Breadcrumbs::for('rti_send_info', function ($trail,$id) {
    $trail->parent('rti_applicants');
    $trail->push('RTI Send Info', route('rti_send_info',$id));
});

Breadcrumbs::for('rti_forwarded_application', function ($trail,$id) {
    $trail->parent('rti_applicants');
    $trail->push('RTI Forward Application', route('rti_forwarded_application',$id));
});

//Resolution
Breadcrumbs::for('resolution', function ($trail) {
    $trail->push('Resolution', route('resolution.index'));
});

Breadcrumbs::for('resolution_create', function ($trail) {
	$trail->parent('resolution');
    $trail->push('Create Resolution', route('resolution.create'));
});
 
Breadcrumbs::for('resolution_edit', function ($trail,$id) {
	$trail->parent('resolution');
    $trail->push('Edit Resolution', route('resolution.edit',$id));
});

Breadcrumbs::for('resolution_view', function ($trail,$id) {
    $trail->parent('resolution');
    $trail->push('View Resolution', route('resolution.view',$id));
});

//Land
Breadcrumbs::for('village_detail', function ($trail) {
	$trail->push('Land Detail', route('village_detail.index'));
});

Breadcrumbs::for('village_create', function ($trail) {
	$trail->parent('village_detail');
	$trail->push('Add Land', route('village_detail.create'));
});

Breadcrumbs::for('village_view', function ($trail,$id) {
	$trail->parent('village_detail');
	$trail->push('View Land', route('village_detail.show',$id));
});

Breadcrumbs::for('village_edit', function ($trail,$id) {
	$trail->parent('village_detail');
	$trail->push('Edit Land', route('village_detail.edit',$id));
});

Breadcrumbs::for('society_detail_land', function ($trail) {
	$trail->push('Society Detail', route('society_detail.index'));
});

Breadcrumbs::for('society_detail', function ($trail) {
	$trail->push('Society Detail', route('society.billing_level'));
});

Breadcrumbs::for('society_details', function ($trail,$id) {
    $trail->parent('society_detail');
    $trail->push('Society List', route('society.billing_level'));
    $trail->push('Society Details', route('society.society_details',['id'=>$id]));
});

Breadcrumbs::for('arrears_charges', function ($trail,$id,$building_id) {
    $trail->parent('society_detail');
    $trail->push('Society List', route('society.billing_level'));
    $trail->push('Society Details', route('society.society_details',['id'=>$id]));
    $trail->push('Arrear Charges Rate', route('arrears_charges',['society_id'=>$id,'building_id'=>$building_id]));
});

Breadcrumbs::for('service_charges', function ($trail,$id,$building_id) {
    $trail->parent('society_detail');
    $trail->push('Society List', route('society.billing_level'));
    $trail->push('Society Details', route('society.society_details',['id'=>$id]));
    $trail->push('Service Charges Rate', route('service_charges',['society_id'=>$id,'building_id'=>$building_id]));
});

Breadcrumbs::for('society_create', function ($trail) {
	$trail->parent('society_detail_land');
	$trail->push('Add Society', route('society_detail.create'));
});

Breadcrumbs::for('society_detail_edit', function ($trail,$id) {
	$trail->parent('society_detail_land',$id);
	$trail->push('Edit Society', route('society_detail.edit',$id));
});

Breadcrumbs::for('society_detail_view', function ($trail,$id) {
	$trail->parent('society_detail_land',$id);
	$trail->push('View Society', route('society_detail.show',$id));
});

Breadcrumbs::for('lease_detail', function ($trail,$id) {
	$trail->push('Lease Detail', route('lease_detail.index',['id'=>$id]));
});

Breadcrumbs::for('lease_create', function ($trail,$id) {
	$trail->parent('lease_detail',$id);
	$trail->push('Add Lease', route('lease_detail.create',['id'=>$id]));
});

Breadcrumbs::for('lease_renew', function ($trail,$id) {
	$trail->parent('lease_detail',$id);
	$trail->push('Renew Lease', route('renew-lease.renew',['id'=>$id]));
});

Breadcrumbs::for('lease_edit', function ($trail,$id,$society_id) {
    $trail->parent('lease_detail',$society_id);
    $trail->push('Edit Lease', route('edit-lease.edit',['id'=>$id, 'society_id'=>$society_id]));
});

Breadcrumbs::for('lease_view', function ($trail,$id,$society_id) {
    $trail->parent('lease_detail',$society_id);
    $trail->push('View Lease', route('view-lease.view',['id'=>$id, 'society_id'=>$society_id]));
});

// Hearing
Breadcrumbs::for('Hearing', function ($trail) {
    $trail->push('Hearing', route('hearing.index'));
});

Breadcrumbs::for('Add Hearing', function ($trail) {
    $trail->parent('Hearing');
    $trail->push('Add Hearing', route('hearing.create'));
});

Breadcrumbs::for('Edit Hearing', function ($trail, $id) {
    $trail->parent('Hearing');
    $trail->push('Edit Hearing', route('hearing.edit', $id));
});

Breadcrumbs::for('View Hearing', function ($trail, $hearing_id) {
    $trail->parent('Hearing');
    $trail->push('View Hearing', route('hearing.show', $hearing_id));
});

// Schedule Hearing

Breadcrumbs::for('Schedule Hearing', function ($trail, $id) {
    $trail->parent('Hearing');
    $trail->push('Schedule Hearing', route('schedule_hearing.add', $id));
});

// Prepone/Postpone Hearing

Breadcrumbs::for('Prepone/Postpone Hearing', function ($trail, $id) {
    $trail->parent('Hearing');
    $trail->push('Prepone/Postpone Hearing', route('fix_schedule.add', $id));
});

// Hearing Case Judgement

Breadcrumbs::for('Upload Case Judgement', function ($trail, $id) {
    $trail->parent('Hearing');
    $trail->push('Upload Case Judgement', route('upload_case_judgement.add', $id));
});

// Forward Hearing

Breadcrumbs::for('Forward Case', function ($trail, $id) {
    $trail->parent('Hearing');
    $trail->push('Forward Case', route('forward_case.create', $id));
});

/*Breadcrumbs::for('Forward Case', function ($trail, $id) {
    $trail->parent('Hearing');
    $trail->push('Forward Case', route('forward_case.edit', $id));
});*/

// Send Notice in Hearing

Breadcrumbs::for('Send Notice To Appellant', function ($trail, $id) {
    $trail->parent('Hearing');
    $trail->push('Send Notice To Appellant', route('send_notice_to_appellant.create', $id));
});

Breadcrumbs::for('society_dashboard', function ($trail) {
    $trail->push('Listing', route('society_offer_letter_dashboard'));
});

Breadcrumbs::for('documents_uploaded', function ($trail,$id) {
    $trail->push('Listing', route('society_offer_letter_dashboard'));
    $trail->push('Documents Uploaded (Offer Letter)', route('documents_uploaded',$id));
});

Breadcrumbs::for('documents_upload', function ($trail,$id) {
    $trail->push('Listing', route('society_offer_letter_dashboard'));
    $trail->push('Documents Upload(Offer Letter)', route('documents_upload',$id));
});

Breadcrumbs::for('rejected_remark', function ($trail,$id) {
    $trail->push('Listing', route('society_offer_letter_dashboard'));
    $trail->push('Rejected Remark', route('view_rejected_remark',$id));
});

Breadcrumbs::for('noc_documents_upload', function ($trail,$id) {
    $trail->push('Listing', route('society_offer_letter_dashboard'));
    $trail->push('Upload documents (NOC)', route('documents_upload_noc',$id));
});

Breadcrumbs::for('oc_documents_upload', function ($trail,$id) {
    $trail->push('Listing', route('society_offer_letter_dashboard'));
    $trail->push('Upload documents (Concent For OC)', route('oc_documents_upload',$id));
});

Breadcrumbs::for('noc_cc_documents_upload', function ($trail) {
    $trail->push('Listing', route('society_offer_letter_dashboard'));
    $trail->push('Upload documents (NOC for CC)', route('documents_upload_noc_cc'));
});

Breadcrumbs::for('revalidation_documents_upload', function ($trail,$id) {
    $trail->push('Listing', route('society_offer_letter_dashboard'));
    $trail->push('Upload documents (Revalidation)', route('reval_documents_upload',$id));
});

Breadcrumbs::for('society_application', function ($trail) {
    $trail->push('Listing', route('society_offer_letter_dashboard'));
    $trail->push('Applications for Redevelopment
', route('society_detail.application'));
});

Breadcrumbs::for('society_offer_application_create', function ($trail, $id) {
    $trail->parent('society_dashboard');
    $trail->push('Application form (Offer Letter)', route('show_form_dev', $id));
});

Breadcrumbs::for('society_revalidation_create', function ($trail, $id) {
    $trail->parent('society_dashboard');
    $trail->push('Application form (Revalidation)', route('show_reval_self', $id));
});

Breadcrumbs::for('society_tripatite_create', function ($trail, $id) {
    $trail->parent('society_dashboard');
    $trail->push('Application form (Tripatite)', route('show_tripatite_self', $id));
});

Breadcrumbs::for('society_oc_application_create', function ($trail, $id) {
    $trail->parent('society_dashboard');
    $trail->push('Application form (Consent For OC)', route('show_oc_self', $id));
});

Breadcrumbs::for('society_noc_application_create', function ($trail, $id) {
    $trail->parent('society_dashboard');
    $trail->push('Application form for Redevelopment (NOC)', route('show_form_self_noc', $id));
});

Breadcrumbs::for('society_noc_cc_application_create', function ($trail, $id) {
    $trail->parent('society_dashboard');
    $trail->push('Application form for Redevelopment (NOC for CC)', route('show_form_self_noc_cc', $id));
});

Breadcrumbs::for('society_offer_letter_edit', function ($trail,$id) {
    $trail->parent('society_dashboard');
    $trail->push('Redevelopment Application Form(Offer Letter)', route('society_offer_letter_edit',$id));
});

Breadcrumbs::for('society_revalidation_edit', function ($trail,$id) {
    $trail->parent('society_dashboard');
    $trail->push('Redevelopment Application Form(Revalidation)', route('society_reval_offer_letter_edit',$id));
});

Breadcrumbs::for('society_oc_edit', function ($trail,$id) {
    $trail->parent('society_dashboard');
    $trail->push('Consent For OC Application Form', route('society_oc_edit',$id));
});

Breadcrumbs::for('noc_edit', function ($trail,$id) {
    $trail->parent('society_dashboard');
    $trail->push('Edit NOC Application(NOC)', route('society_noc_edit',$id));
});

Breadcrumbs::for('noc_cc_edit', function ($trail) {
    $trail->parent('society_dashboard');
    $trail->push('Edit NOC (CC) Application', route('society_noc_cc_edit'));
});

//cap Breadcrumbs

Breadcrumbs::for('cap', function ($trail) {
    $trail->push('Home', route('cap.index'));
});

Breadcrumbs::for('cap_reval', function ($trail) {
    $trail->push('Home', route('cap_applications.reval'));
});
Breadcrumbs::for('society_reval_documents_cap', function ($trail,$id) {
    $trail->parent('cap_reval');
    $trail->push('society reval documents cap', route('cap.society_reval_documents',$id));
});
Breadcrumbs::for('society_EE_documents_cap', function ($trail,$id) {
    $trail->parent('cap');
    $trail->push('Society EE Documents', route('common.view_society_EE_documents',$id));
}); 

Breadcrumbs::for('EE_scrutiny_cap', function ($trail,$id) {
    $trail->parent('cap');
    $trail->push('EE Scrutiny', route('common.EE_Scrutiny_Remark',$id));
});

Breadcrumbs::for('DYCE_scrutiny_cap', function ($trail,$id) {
    $trail->parent('cap');
    $trail->push('DYCE Scrutiny', route('common.dyce_scrutiny_remark',$id));
});

// Breadcrumbs::for('REE_calculation_cap', function ($trail,$id) {
//     $trail->parent('cap');
//     $trail->push('REE_calculation', route('cap.dyce_Scrutiny_Remark',$id));
// });
Breadcrumbs::for('calculation_sheet_cap', function ($trail,$id) {
    $trail->parent('cap');
    $trail->push('calculation sheet', route('cap.show_calculation_sheet',$id));
});

Breadcrumbs::for('Forward_Application_cap', function ($trail,$id) {
    $trail->parent('cap');
    $trail->push('forward application', route('cap.forward_application',$id));
});

Breadcrumbs::for('Forward_Reval_Application_cap', function ($trail,$id) {
    $trail->parent('cap_reval');
    $trail->push('forward Reval application', route('cap.forward_reval_application',$id));
});

Breadcrumbs::for('cap_note_cap', function ($trail,$id) {
    $trail->parent('cap');
    $trail->push('cap note', route('cap.cap_notes',$id));
});

//vp Breadcrumbs

Breadcrumbs::for('vp', function ($trail) {
    $trail->push('Home', route('vp.index'));
});

Breadcrumbs::for('vp_reval', function ($trail) {
    $trail->push('Home', route('vp_applications.reval'));
});

Breadcrumbs::for('society_reval_documents_vp', function ($trail,$id) {
    $trail->parent('vp_reval');
    $trail->push('society reval documents vp', route('vp.society_reval_documents',$id));
});

Breadcrumbs::for('society_EE_documents_vp', function ($trail,$id) {
    $trail->parent('vp');
    $trail->push('society_EE_documents', route('common.view_society_EE_documents',$id));
});

Breadcrumbs::for('EE_scrutiny_vp', function ($trail,$id) {
    $trail->parent('vp');
    $trail->push('EE_scrutiny', route('common.EE_Scrutiny_Remark',$id));
});

Breadcrumbs::for('DYCE_scrutiny_vp', function ($trail,$id) {
    $trail->parent('vp');
    $trail->push('DYCE_scrutiny', route('common.dyce_scrutiny_remark',$id));
});

// Breadcrumbs::for('REE_calculation_cap', function ($trail,$id) {
//     $trail->parent('vp');
//     $trail->push('REE_calculation', route('vp.forward_application',$id));
// });
Breadcrumbs::for('calculation_sheet_vp', function ($trail,$id) {
    $trail->parent('vp');
    $trail->push('calculation_sheet', route('vp.show_calculation_sheet',$id));
});

Breadcrumbs::for('Forward_Application_vp', function ($trail,$id) {
    $trail->parent('vp');
    $trail->push('Forward_Application', route('vp.forward_application',$id));
});
Breadcrumbs::for('Forward_Reval_Application_vp', function ($trail,$id) {
    $trail->parent('vp_reval');
    $trail->push('Forward_Reval_Application', route('vp.forward_reval_application',$id));
});

Breadcrumbs::for('cap_note_vp', function ($trail,$id) {
    $trail->parent('vp');
    $trail->push('cap_note', route('vp.cap_notes',$id));
});

//co Breadcrumbs

Breadcrumbs::for('co', function ($trail) {
    $trail->push('Home', route('co.index'));
});

Breadcrumbs::for('co_reval', function ($trail) {
    $trail->push('Home', route('co_applications.reval'));
});

Breadcrumbs::for('co_noc', function ($trail) {
    $trail->push('Home', route('co_applications.noc'));
});

Breadcrumbs::for('co_noc_cc', function ($trail) {
    $trail->push('Home', route('co_applications.noc_cc'));
});

Breadcrumbs::for('society_EE_documents_co', function ($trail,$id) {
    $trail->parent('co');
    $trail->push('society_EE_documents', route('common.view_society_EE_documents',$id));
});

Breadcrumbs::for('society_reval_documents_co', function ($trail,$id) {
    $trail->parent('co_reval');
    $trail->push('society reval documents', route('co.society_reval_documents',$id));
});

Breadcrumbs::for('society_noc_documents_co', function ($trail,$id) {
    $trail->parent('co_noc');
    $trail->push('Society Documents', route('co.society_noc_documents',$id));
});

Breadcrumbs::for('society_noc_cc_documents_co', function ($trail,$id) {
    $trail->parent('co_noc_cc');
    $trail->push('Society Documents', route('co.society_noc_cc_documents',$id));
});

Breadcrumbs::for('EE_scrutiny_co', function ($trail,$id) {
    $trail->parent('co');
    $trail->push('EE_scrutiny', route('common.EE_Scrutiny_Remark',$id));
});

Breadcrumbs::for('scrutiny-remark-noc_co', function ($trail,$id) {
    $trail->parent('co_noc');
    $trail->push('REE Scrutiny', route('co.noc_scrutiny_remarks',$id));

});

Breadcrumbs::for('scrutiny-remark-noc_cc_co', function ($trail,$id) {
    $trail->parent('co_noc_cc');
    $trail->push('REE Scrutiny', route('co.noc_cc_scrutiny_remarks',$id));

});

Breadcrumbs::for('DYCE_scrutiny_co', function ($trail,$id) {
    $trail->parent('co');
    $trail->push('DYCE Scrutiny', route('common.dyce_scrutiny_remark',$id));
});

Breadcrumbs::for('Approve_offer_letter', function ($trail,$id) {
    $trail->parent('co');
    $trail->push('Approve_offer_letter', route('co.approve_offer_letter',$id));
});
Breadcrumbs::for('Approve_reval_offer_letter', function ($trail,$id) {
    $trail->parent('co_reval');
    $trail->push('Approve_reval_offer_letter', route('co.approve_reval_offer_letter',$id));
});

Breadcrumbs::for('issue_noc', function ($trail,$id) {
    $trail->parent('co_noc');
    $trail->push('Approve Noc', route('co.approve_noc',$id));
});

Breadcrumbs::for('issue_noc_cc', function ($trail,$id) {
    $trail->parent('co_noc_cc');
    $trail->push('Approve Noc', route('co.approve_noc_cc',$id));
});

// Breadcrumbs::for('REE_calculation_cap', function ($trail,$id) {
//     $trail->parent('co');
//     $trail->push('REE_calculation', route('vp.forward_application',$id));
// });
Breadcrumbs::for('calculation_sheet_co', function ($trail,$id) {
    $trail->parent('co');
    $trail->push('calculation_sheet', route('co.show_calculation_sheet',$id));
});


Breadcrumbs::for('Forward_Application_co', function ($trail,$id) {
    $trail->parent('co');
    $trail->push('Forward_Application', route('co.forward_application',$id));
});

Breadcrumbs::for('Forward_Reval_Application_co', function ($trail,$id) {
    $trail->parent('co_reval');
    $trail->push('Forward_Application', route('co.forward_reval_application',$id));
});

Breadcrumbs::for('Forward_noc_Application_co', function ($trail,$id) {
    $trail->parent('co_noc');
    $trail->push('Forward Application', route('co.forward_noc_application',$id));
});

Breadcrumbs::for('Forward_noc_cc_Application_co', function ($trail,$id) {
    $trail->parent('co_noc_cc');
    $trail->push('Forward Application', route('co.forward_noc_cc_application',$id));
});

Breadcrumbs::for('download_cap_note', function ($trail,$id) {
    $trail->parent('co');
    $trail->push('cap_note', route('co.download_cap_note',$id));
});

//REE Breadcrumbs

Breadcrumbs::for('ree', function ($trail) {
    $trail->push('Home', route('ree_applications.index'));
});

Breadcrumbs::for('ree_reval', function ($trail) {
    $trail->push('Home', route('ree_applications.reval'));
});

Breadcrumbs::for('ree_noc', function ($trail) {
    $trail->push('Home', route('ree_applications.noc'));
});

Breadcrumbs::for('ree_noc_cc', function ($trail) {
    $trail->push('Home', route('ree_applications.noc_cc'));
});

Breadcrumbs::for('society_EE_documents_ree', function ($trail,$id) {
    $trail->parent('ree');
    $trail->push('Society EE Documents', route('common.view_society_EE_documents',$id));
});

Breadcrumbs::for('society_noc_documents_ree', function ($trail,$id) {
    $trail->parent('ree_noc');
    $trail->push('Society documents', route('ree.society_noc_documents',$id));
});

Breadcrumbs::for('society_noc_cc_documents_ree', function ($trail,$id) {
    $trail->parent('ree_noc_cc');
    $trail->push('Society Documents', route('ree.society_noc_cc_documents',$id));
});

Breadcrumbs::for('society_reval_documents_ree', function ($trail,$id) {
    $trail->parent('ree_reval');
    $trail->push('society reval documents', route('ree.society_reval_documents',$id));
});

Breadcrumbs::for('EE_scrutiny_ree', function ($trail,$id) {
    $trail->parent('ree');
    $trail->push('EE Scrutiny', route('common.EE_Scrutiny_Remark',$id));
});

Breadcrumbs::for('DYCE_scrutiny_ree', function ($trail,$id) {
    $trail->parent('ree');
    $trail->push('DYCE Scrutiny', route('common.dyce_scrutiny_remark',$id));
});

Breadcrumbs::for('calculation_sheet', function ($trail,$id) {
    $trail->parent('ree');
    $trail->push('calculation sheet', route('ol_calculation_sheet.index',$id));
});

Breadcrumbs::for('reval_calculation_sheet', function ($trail,$id) {
    $trail->parent('ree_reval');
    $trail->push('reval calculation sheet', route('ol_reval_calculation_sheet.show',$id));
});

Breadcrumbs::for('reval_co_calculation_sheet', function ($trail,$id) {
    $trail->parent('co_reval');
    $trail->push('reval calculation sheet', route('co.show_reval_calculation_sheet',$id));
});

Breadcrumbs::for('reval_cap_calculation_sheet', function ($trail,$id) {
    $trail->parent('cap_reval');
    $trail->push('reval calculation sheet', route('cap.show_reval_calculation_sheet',$id));
});

Breadcrumbs::for('reval_vp_calculation_sheet', function ($trail,$id) {
    $trail->parent('vp_reval');
    $trail->push('reval calculation sheet', route('vp.show_reval_calculation_sheet',$id));
});

Breadcrumbs::for('approved_offer_letter', function ($trail,$id) {
    $trail->parent('ree');
    $trail->push('Offer Letter', route('ree.approved_offer_letter',$id));
});

Breadcrumbs::for('approved_reval_offer_letter', function ($trail,$id) {
    $trail->parent('ree_reval');
    $trail->push('approved reval offer letter', route('ree.approved_reval_offer_letter',$id));
});

Breadcrumbs::for('approved_noc', function ($trail,$id) {
    $trail->parent('ree_noc');
    $trail->push('Approved Noc', route('ree.approved_noc_letter',$id));
});

Breadcrumbs::for('approved_noc_cc', function ($trail,$id) {
    $trail->parent('ree_noc_cc');
    $trail->push('Approved Noc', route('ree.approved_noc_cc_letter',$id));
});

Breadcrumbs::for('generate_offer_letter', function ($trail,$id) {
    $trail->parent('ree');
    $trail->push('generate offer letter', route('ree.generate_offer_letter',$id));
});

Breadcrumbs::for('generate_noc', function ($trail,$id) {
    $trail->parent('ree_noc');
    $trail->push('Generate Noc', route('ree.generate_noc',$id));
});

Breadcrumbs::for('generate_noc_cc', function ($trail,$id) {
    $trail->parent('ree_noc_cc');
    $trail->push('Generate Noc', route('ree.generate_noc_cc',$id));
});

 Breadcrumbs::for('REE_calculation', function ($trail,$id) {
     $trail->parent('ree');
     $trail->push('Calculation Sheet', route('ree.show_calculation_sheet',$id));
 });

Breadcrumbs::for('Forward_Application_ree', function ($trail,$id) {
    $trail->parent('ree');
    $trail->push('Forward Application', route('ree.forward_application',$id));
});

Breadcrumbs::for('Forward_Application_ree_noc', function ($trail,$id) {
    $trail->parent('ree_noc');
    $trail->push('Forward Application', route('ree.forward_application_noc',$id));
});

Breadcrumbs::for('Forward_Application_ree_noc_cc', function ($trail,$id) {
    $trail->parent('ree_noc_cc');
    $trail->push('Forward Application', route('ree.forward_application_noc_cc',$id));
});

Breadcrumbs::for('cap_note_ree', function ($trail,$id) {
    $trail->parent('ree');
    $trail->push('cap note', route('ree.download_cap_note',$id));
});

Breadcrumbs::for('reval_cap_note_ree', function ($trail,$id) {
    $trail->parent('ree_reval');
    $trail->push('reval cap note', route('ree.download_reval_cap_note',$id));
});

Breadcrumbs::for('ee', function ($trail) {
	$trail->push('Home', route('ee.index'));
});

Breadcrumbs::for('ee_for_oc', function ($trail) {
    $trail->push('Home', route('ee.consent_for_oc'));
});

Breadcrumbs::for('view_oc_application_ee', function ($trail,$id) {
    $trail->parent('ee_for_oc');
    $trail->push('View application for consent for OC', route('ee.view_oc_application',$id));
});

Breadcrumbs::for('ee_society_documents_oc', function ($trail,$id) {
    $trail->parent('ee_for_oc');
    $trail->push('Society Documents', route('ee.society_documents_oc',$id));
});

Breadcrumbs::for('scrutiny-remark-ee-oc', function ($trail,$id) {
    $trail->parent('ee_for_oc');
    $trail->push('EE Scrutiny', route('ee.scrutiny-remark-oc',$id));
});

Breadcrumbs::for('Forward_Application_oc', function ($trail,$id) {
    $trail->parent('ee_for_oc');
    $trail->push('Forward Application', route('ee-forward-application-oc',$id));
});

Breadcrumbs::for('em_for_oc', function ($trail) {
    $trail->push('Home', route('em.consent_for_oc'));
});

Breadcrumbs::for('em_society_documents_oc', function ($trail,$id) {
    $trail->parent('em_for_oc');
    $trail->push('Society Documents', route('em.society_documents_oc',$id));
});

Breadcrumbs::for('em_generate_no_due_certificate', function ($trail,$id) {
    $trail->parent('em_for_oc');
    $trail->push('No dues certificate', route('em.no_dues_certifitce',$id));
});

Breadcrumbs::for('Forward_Application_oc_em', function ($trail,$id) {
    $trail->parent('em_for_oc');
    $trail->push('Forward Application', route('em-forward-application-oc',$id));
});

Breadcrumbs::for('ree_oc', function ($trail) {
    $trail->push('Home', route('ree_applications.consent_oc'));
});

Breadcrumbs::for('ree_society_document_oc', function ($trail,$id) {
    $trail->parent('ree_oc');
    $trail->push('Society Documents', route('ree.society_oc_documents',$id));
});

Breadcrumbs::for('em-scrutiny-oc-ree', function ($trail,$id) {
    $trail->parent('ree_oc');
    $trail->push('EM Scrutiny', route('ree.em_scrutiny_oc_ree',$id));
});

Breadcrumbs::for('scrutiny-remark-oc-ee', function ($trail,$id) {
    $trail->parent('ree_oc');
    $trail->push('EE Scrutiny', route('ree.ee_scrutiny_oc_ree',$id));
});

Breadcrumbs::for('generate_consent_oc', function ($trail,$id) {
    $trail->parent('ree_oc');
    $trail->push('Generate Consent for OC', route('ree.generate_oc_certificate',$id));
});

Breadcrumbs::for('scrutiny-remark-oc-ree', function ($trail,$id) {
    $trail->parent('ree_oc');
    $trail->push('REE Note', route('ree.ree-note-consentoc',$id));
});

Breadcrumbs::for('Forward_Application_ree_oc', function ($trail,$id) {
    $trail->parent('ree_oc');
    $trail->push('Forward Application', route('ree-forward-application-oc',$id));
});

Breadcrumbs::for('co_consent_oc', function ($trail) {
    $trail->push('Home', route('co_applications.consent_oc'));
});

Breadcrumbs::for('society_oc_documents_co', function ($trail,$id) {
    $trail->parent('co_consent_oc');
    $trail->push('Society Documents', route('co.society_oc_documents',$id));
});

Breadcrumbs::for('em-scrutiny-oc-co', function ($trail,$id) {
    $trail->parent('co_consent_oc');
    $trail->push('EM Scrutiny', route('co.em_scrutiny_oc_co',$id));
});

Breadcrumbs::for('scrutiny-remark-oc-ee-co', function ($trail,$id) {
    $trail->parent('co_consent_oc');
    $trail->push('EE Scrutiny', route('co.ee_scrutiny_oc_co',$id));
});

Breadcrumbs::for('ree-note-oc_co', function ($trail,$id) {
    $trail->parent('co_consent_oc');
    $trail->push('REE Note', route('co.ree_note_oc_co',$id));
});

Breadcrumbs::for('issue_consent_oc', function ($trail,$id) {
    $trail->parent('co_consent_oc');
    $trail->push('Approve Consent for OC', route('co.approve_consent_oc',$id));
});

Breadcrumbs::for('Forward_oc_Application_co', function ($trail,$id) {
    $trail->parent('co_consent_oc');
    $trail->push('Forward Application', route('co-forward-application-oc',$id));
});

Breadcrumbs::for('approved_oc', function ($trail,$id) {
    $trail->parent('ree_oc');
    $trail->push('Approved Consent for OC', route('ree.approved_consent_oc_letter',$id));
});

//offer letter
Breadcrumbs::for('view_application_ee', function ($trail,$id) {
    $trail->parent('ee');
    $trail->push('View Application', route('ee.view_application',$id));
});

Breadcrumbs::for('view_application_vp', function ($trail,$id) {
    $trail->parent('vp');
    $trail->push('View Application', route('vp.view_application',$id));
});

Breadcrumbs::for('view_application_ree', function ($trail,$id) {
    $trail->parent('ree');
    $trail->push('View Application', route('ree.view_application',$id));
});

Breadcrumbs::for('view_reval_application_ree', function ($trail,$id) {
    $trail->parent('ree_reval');
    $trail->push('View Application', route('ree.view_reval_application',$id));
});

Breadcrumbs::for('reval_Forward_Application_ree', function ($trail,$id) {
    $trail->parent('ree_reval');
    $trail->push('Forward Application', route('ree.view_reval_application',$id));
});

Breadcrumbs::for('view_noc_application_ree', function ($trail,$id) {
    $trail->parent('ree_noc');
    $trail->push('View Application', route('ree.view_application_noc',$id));
});

Breadcrumbs::for('view_noc_cc_application_ree', function ($trail,$id) {
    $trail->parent('ree_noc_cc');
    $trail->push('View Application', route('ree.view_application_noc_cc',$id));
});

Breadcrumbs::for('view_application_co', function ($trail,$id) {
    $trail->parent('co');
    $trail->push('View Application', route('co.view_application',$id));
});

Breadcrumbs::for('view_application_dyce', function ($trail,$id) {
    $trail->parent('dyce');
    $trail->push('View Application', route('dyce.view_application',$id));
});

Breadcrumbs::for('view_application', function ($trail,$id) {
    $trail->parent('cap');
    $trail->push('View Application', route('cap.view_application',$id));
});


//ee

Breadcrumbs::for('document-submitted', function ($trail,$id) {
    $trail->parent('ee');
    $trail->push('Society Documents', route('document-submitted',$id));
});

Breadcrumbs::for('scrutiny-remark', function ($trail,$id,$societyId) {
    $trail->parent('ee');

$trail->push('Scrutiny Remark', route('scrutiny-remark',['id'=>$id,'society_id'=>$societyId]));

});

Breadcrumbs::for('scrutiny-remark-noc', function ($trail,$id) {
    $trail->parent('ree_noc');
    $trail->push('REE Scrutiny', route('ree.scrutiny-remark-noc',$id));

});

Breadcrumbs::for('view_application_noc_cc', function ($trail,$id) {
    $trail->parent('ree_noc_cc');
    $trail->push('View Application', route('cap.view_application',$id));
});

Breadcrumbs::for('scrutiny-remark-noc-cc', function ($trail,$id) {
    $trail->parent('ree_noc_cc');
    $trail->push('REE Note', route('ree.scrutiny-remark-noc-cc',$id));

});

Breadcrumbs::for('Forward_Application_ee', function ($trail,$id) {
    $trail->parent('ee');
    $trail->push('Forward Application', route('get-forward-application',$id));
});

//Dyce


Breadcrumbs::for('dyce', function ($trail) {
	$trail->push('Home', route('dyce.index'));
});

Breadcrumbs::for('society_EE_documents', function ($trail,$id) {
    $trail->parent('dyce');
    $trail->push('Society EE Documents', route('common.view_society_EE_documents',$id));
});

Breadcrumbs::for('EE_Scrutiny_Remark-dyce', function ($trail,$id) {
    $trail->parent('dyce');
    $trail->push('EE Scrutiny Remark', route('common.EE_Scrutiny_Remark',$id));
});

Breadcrumbs::for('scrutiny_remark-dyce', function ($trail,$id) {
    $trail->parent('dyce');
    $trail->push('Scrutiny Remark', route('dyce.scrutiny_remark',$id));
});

Breadcrumbs::for('forward_application-dyce', function ($trail,$id) {
    $trail->parent('dyce');
    $trail->push('Forward Application', route('dyce.forward_application',$id));
});

//Role
Breadcrumbs::for('role', function ($trail) {
    $trail->push('Home', route('roles.index'));
});

Breadcrumbs::for('add_role', function ($trail) {
    $trail->parent('role');
    $trail->push('Create Role', route('roles.create'));
});

Breadcrumbs::for('role_detail', function ($trail) {
    $trail->push('Role Detail', route('roles.index'));
});

Breadcrumbs::for('edit_role', function ($trail,$id) {
    $trail->parent('role_detail');
    $trail->push('Edit Role', route('roles.edit',$id));
});

Breadcrumbs::for('role_view', function ($trail,$id) {
    $trail->parent('role');
    $trail->push('View Role', route('roles.show',$id));
});

//Application Status
Breadcrumbs::for('application_status', function ($trail) {
    $trail->push('Home', route('application_status.index'));
});

Breadcrumbs::for('add_application_status', function ($trail) {
    $trail->parent('application_status');
    $trail->push('Create Application Status', route('application_status.create'));
});

Breadcrumbs::for('application_status_detail', function ($trail) {
    $trail->push('Application Status Detail', route('application_status.index'));
});

Breadcrumbs::for('edit_application_status', function ($trail,$id) {
    $trail->parent('application_status_detail');
    $trail->push('Edit Application Status', route('application_status.edit',$id));
});

Breadcrumbs::for('application_status_view', function ($trail,$id) {
    $trail->parent('application_status');
    $trail->push('View Application Status', route('application_status.show',$id));
});

// Hearing Status
Breadcrumbs::for('hearing_status', function ($trail) {
    $trail->push('Home', route('hearing_status.index'));
});

Breadcrumbs::for('add_hearing_status', function ($trail) {
    $trail->parent('hearing_status');
    $trail->push('Create Hearing Status', route('hearing_status.create'));
});

Breadcrumbs::for('hearing_status_detail', function ($trail) {
    $trail->push('Hearing Status Detail', route('hearing_status.index'));
});

Breadcrumbs::for('edit_hearing_status', function ($trail,$id) {
    $trail->parent('hearing_status_detail');
    $trail->push('Edit Hearing Status', route('hearing_status.edit',$id));
});

Breadcrumbs::for('hearing_status_view', function ($trail,$id) {
    $trail->parent('hearing_status');
    $trail->push('View Hearing Status', route('hearing_status.show',$id));
});

// RTI Status
Breadcrumbs::for('rti_status', function ($trail) {
    $trail->push('Home', route('rti_status.index'));
});

Breadcrumbs::for('add_rti_status', function ($trail) {
    $trail->parent('rti_status');
    $trail->push('Create RTI Status', route('rti_status.create'));
});

Breadcrumbs::for('rti_status_detail', function ($trail) {
    $trail->push('RTI Status Detail', route('rti_status.index'));
});

Breadcrumbs::for('edit_rti_status', function ($trail,$id) {
    $trail->parent('rti_status_detail');
    $trail->push('Edit RTI Status', route('rti_status.edit',$id));
});

Breadcrumbs::for('rti_status_view', function ($trail,$id) {
    $trail->parent('rti_status');
    $trail->push('View RTI Status', route('rti_status.show',$id));
});

// Layouts
Breadcrumbs::for('layout', function ($trail) {
    $trail->push('Home', route('layouts.index'));
});

Breadcrumbs::for('add_layout', function ($trail) {
    $trail->parent('layout');
    $trail->push('Create Layout', route('layouts.create'));
});

Breadcrumbs::for('layout_detail', function ($trail) {
    $trail->push('Layout Detail', route('layouts.index'));
});

Breadcrumbs::for('edit_layout', function ($trail,$id) {
    $trail->parent('layout_detail');
    $trail->push('Edit Layout', route('layouts.edit',$id));
});

Breadcrumbs::for('layout_view', function ($trail,$id) {
    $trail->parent('layout');
    $trail->push('View Layout', route('layouts.show',$id));
});

// Users
Breadcrumbs::for('user', function ($trail) {
    $trail->push('Home', route('users.index'));
});

Breadcrumbs::for('add_user', function ($trail) {
    $trail->parent('user');
    $trail->push('Create User', route('users.create'));
});

Breadcrumbs::for('user_detail', function ($trail) {
    $trail->push('User Detail', route('users.index'));
});

Breadcrumbs::for('edit_user', function ($trail,$id) {
    $trail->parent('user_detail');
    $trail->push('Edit User', route('users.edit',$id));
});

Breadcrumbs::for('user_view', function ($trail,$id) {
    $trail->parent('user');
    $trail->push('View User', route('users.show',$id));
});

// User Layouts
Breadcrumbs::for('user_layout', function ($trail) {
    $trail->push('Home', route('user_layouts.index'));
});

Breadcrumbs::for('add_user_layout', function ($trail) {
    $trail->parent('user_layout');
    $trail->push('Create User Layout', route('user_layouts.create'));
});

Breadcrumbs::for('user_layout_detail', function ($trail) {
    $trail->push('User Layout Detail', route('user_layouts.index'));
});

Breadcrumbs::for('edit_user_layout', function ($trail,$id) {
    $trail->parent('user_layout_detail');
    $trail->push('Edit User Layout', route('user_layouts.edit',$id));
});

Breadcrumbs::for('user_layout_view', function ($trail,$id) {
    $trail->parent('user_layout');
    $trail->push('View User Layout', route('user_layouts.show',$id));
});


//Ward
Breadcrumbs::for('ward', function ($trail) {
    $trail->push('Home', route('ward.index'));
});

Breadcrumbs::for('add_ward', function ($trail) {
    $trail->parent('ward');
    $trail->push('Create Ward', route('ward.create'));
});

Breadcrumbs::for('ward_detail', function ($trail) {
    $trail->push('Ward Detail', route('ward.index'));
});

Breadcrumbs::for('edit_ward', function ($trail,$id) {
    $trail->parent('ward_detail');
    $trail->push('Edit Ward', route('ward.edit',$id));
});

Breadcrumbs::for('ward_view', function ($trail,$id) {
    $trail->parent('ward');
    $trail->push('View Ward', route('ward.show',$id));
});

//Colony
Breadcrumbs::for('colony', function ($trail) {
    $trail->push('Home', route('colony.index'));
});

Breadcrumbs::for('add_colony', function ($trail) {
    $trail->parent('colony');
    $trail->push('Create Colony', route('colony.create'));
});

Breadcrumbs::for('colony_detail', function ($trail) {
    $trail->push('Colony Detail', route('colony.index'));
});

Breadcrumbs::for('edit_colony', function ($trail,$id) {
    $trail->parent('colony_detail');
    $trail->push('Edit Colony', route('colony.edit',$id));
});

Breadcrumbs::for('colony_view', function ($trail,$id) {
    $trail->parent('colony');
    $trail->push('View Colony', route('colony.show',$id));
});


Breadcrumbs::for('em', function ($trail) {
    $trail->push('Home', route('em.index'));
});

Breadcrumbs::for('society_list',function($trail){
    $trail->parent('em');
    $trail->push('Society List',route('get_societies'));
});

Breadcrumbs::for('building_list',function($trail,$id){
    $trail->parent('em');
    $trail->push('Society List',route('get_societies'));
    $trail->push('List of Buildings',route('get_buildings',['id' => $id]));
});

Breadcrumbs::for('tenant_list',function($trail,$id,$building_id){
    $trail->parent('em');
    $trail->push('Society List',route('get_societies'));
    $trail->push('List of Buildings',route('get_buildings',['id' => $id]));
    $trail->push('Tenant List',route('get_tenants',['id' => $building_id]));
});

Breadcrumbs::for('rc', function ($trail) {
    $trail->push('Home', route('rc.index'));
});

Breadcrumbs::for('em_clerk', function ($trail) {
    $trail->push('Home', route('em_clerk.index'));
});

Breadcrumbs::for('arrear_payment_details', function ($trail) {
    $trail->parent('em_clerk');
    $trail->push('Payment List', route('tenant_payment_list'));
});

//architect application

Breadcrumbs::for('architect_application', function ($trail) {
    $trail->push('architect_application', route('architect_application'));
});
Breadcrumbs::for('evaluate_application', function ($trail,$id) {
    $trail->parent('architect_application');
    $trail->push('Evaluate Application', route('evaluate_architect_application',['id'=>$id]));
});

Breadcrumbs::for('view_architect_application', function ($trail,$id) {
    $trail->parent('architect_application');
    $trail->push('View', route('view_architect_application',['id'=>$id]));
});

Breadcrumbs::for('forward_architect_application', function ($trail,$id) {
    $trail->parent('architect_application');
    $trail->push('Forward Application', route('architect.forward_application',['id'=>$id]));
});

Breadcrumbs::for('architect_generate_certificate', function ($trail,$id) {
    $trail->parent('architect_application');
    $trail->push('Generate Certificate', route('generate_certificate',['id'=>$id]));
});

Breadcrumbs::for('architect_finalCertificateGenerate', function ($trail,$id) {
    $trail->parent('architect_application');
    $trail->push('View Certificate', route('finalCertificateGenerate',['id'=>$id]));
});

//architect layouts

Breadcrumbs::for('architect_layout', function ($trail) {
    $trail->push('architect_layout', route('architect_layout.index'));
});

Breadcrumbs::for('architect_layout_details', function ($trail,$id) {
    $trail->parent('architect_layout');
    $trail->push('View Details', route('architect_layout_details.view',['layout_id'=>$id]));
});

Breadcrumbs::for('list_off_issued_offer_letter', function ($trail,$id) {
    $trail->parent('architect_layout');
    $trail->push('List of Offer Letter Issued', route('list_of_offer_letter_issued',['layout_id'=>$id]));
});

Breadcrumbs::for('architect_layout_scrutiny_remarks', function ($trail,$id) {
    $trail->parent('architect_layout');
    $trail->push('Scrutiny & Remark', route('architect_layout_get_scrtiny',['layout_id'=>$id]));
});

Breadcrumbs::for('architect_layout_add_details', function ($trail,$id) {
    $trail->parent('architect_layout_details',$id);
    $trail->push('Add Details', route('architect_layout_detail.edit',['layout_id'=>$id]));
});

Breadcrumbs::for('architect_layout_forward', function ($trail,$id) {
    $trail->parent('architect_layout');
    $trail->push('Forward Application', route('forward_architect_layout',['layout_id'=>$id]));
});

Breadcrumbs::for('architect_Layout_scrutiny_of_ee_em_lm_ree', function ($trail,$id) {
    $trail->parent('architect_layout');
    $trail->push('Scrutiny of EE EM LM REE', route('architect_Layout_scrutiny_of_ee_em_lm_ree',['layout_id'=>$id]));
});

Breadcrumbs::for('architect_layout_prepare_layout_excel', function ($trail,$id) {
    $trail->parent('architect_layout');
    $trail->push('Layout & Excel', route('architect_layout_prepare_layout_excel',['layout_id'=>$id]));
});

//Society Formation
Breadcrumbs::for('society_formation',function($trail){
    $trail->push('Home',route('society_formation.index'));
});


Breadcrumbs::for('society_formation_list',function($trail){
    $trail->push('Home',route('get_sf_applications.index'));
});

Breadcrumbs::for('sf_view_application', function ($trail,$id) {
    $trail->parent('society_formation_list');
    $trail->push('View Application', route('formation.view_application',['layout_id'=>$id]));
});

Breadcrumbs::for('sf_documents', function ($trail,$id) {
    $trail->parent('society_formation_list');
    $trail->push('Society Documents', route('formation.society_documents',['layout_id'=>$id]));
});

Breadcrumbs::for('sf_srutiny_and_remark', function ($trail,$id) {
    $trail->parent('society_formation_list');
    $trail->push('Srutiny & Remark', route('formation.em_srutiny_and_remark',['layout_id'=>$id]));
});

Breadcrumbs::for('sf_forward_application', function ($trail,$id) {
    $trail->parent('society_formation_list');
    $trail->push('Forward Application', route('formation.forward_application',['layout_id'=>$id]));
});

//Accounts
Breadcrumbs::for('search_accounts',function($trail){
    $trail->push('Home',route('search_accounts'));
});

Breadcrumbs::for('account_search', function ($trail) {
    $trail->parent('search_accounts');
    $trail->push('Tenantment Calculations');
});

Breadcrumbs::for('calculations', function ($trail,$layout_id,$society_id,$building_id) {
    $trail->parent('search_accounts');
    $trail->push('Tenantment Calculations', route('account_search',['layout_id'=>$layout_id,'society_id'=>$society_id,'building_id'=>$building_id]));
    $trail->push('Calculations');
});

Breadcrumbs::for('payment_details', function ($trail,$layout_id,$society_id,$building_id) {
    $trail->parent('search_accounts');
    $trail->push('Tenantment Calculations', route('account_search',['layout_id'=>$layout_id,'society_id'=>$society_id,'building_id'=>$building_id]));
    $trail->push('Payment Details');
});

//Conveyance 

Breadcrumbs::for('society_conveyance',function($trail){
    $trail->push('Home',route('conveyance.index'));
});

Breadcrumbs::for('conveyance_view_application', function ($trail,$id) {
    $trail->parent('society_conveyance');
    $trail->push('View Application', route('conveyance.view_application',$id));
});

Breadcrumbs::for('conveyance_society_document', function ($trail,$id) {
    $trail->parent('society_conveyance');
    $trail->push('Society Documents', route('conveyance.view_documents',$id));
});

Breadcrumbs::for('conveyance_forward_application', function ($trail,$id) {
    $trail->parent('society_conveyance');
    $trail->push('Forward Application', route('conveyance.forward_application_sc',$id));
});

Breadcrumbs::for('conveyance_architect_scrutiny', function ($trail,$id) {
    $trail->parent('society_conveyance');
    $trail->push('Architect Scrutiny', route('conveyance.architect_scrutiny_remark',$id));
});

Breadcrumbs::for('conveyance_ee_calculation', function ($trail,$id) {
    $trail->parent('society_conveyance');
    $trail->push('EE Scrutiny', route('ee.sale_price_calculation',$id));
});

Breadcrumbs::for('conveyance_draft_sale_lease', function ($trail,$id) {
    $trail->parent('society_conveyance');
    $trail->push('Sale & Lease Deed', route('conveyance.sale_lease_agreement',$id));
});

Breadcrumbs::for('conveyance_approve_sale_lease', function ($trail,$id) {
    $trail->parent('society_conveyance');
    $trail->push('Approved Sale & Lease Deed', route('conveyance.approved_sale_lease_agreement',$id));
});

Breadcrumbs::for('conveyance_checklist', function ($trail,$id) {
    $trail->parent('society_conveyance');
    $trail->push('Checklist & Office Note', route('conveyance.checklist',$id));
});

Breadcrumbs::for('conveyance_stamp_sale_lease', function ($trail,$id) {
    $trail->parent('society_conveyance');
    $trail->push('Stamp Sale & Lease Deed', route('conveyance.stamp_duty_agreement',$id));
});

Breadcrumbs::for('conveyance_stamp_sign_sale_lease', function ($trail,$id) {
    $trail->parent('society_conveyance');
    $trail->push('Stamp Sign Sale & Lease Deed', route('conveyance.stamp_signed_duty_agreement',$id));
});

Breadcrumbs::for('conveyance_registered_sale_lease', function ($trail,$id) {
    $trail->parent('society_conveyance');
    $trail->push('Registered Sale & Lease Deed', route('conveyance.register_sale_lease_agreement',$id));
});

Breadcrumbs::for('conveyance_em_scrutiny', function ($trail,$id) {
    $trail->parent('society_conveyance');
    $trail->push('EM Scrutiny Remark', route('em.scrutiny_remark',$id));
});

Breadcrumbs::for('noc_for_conveyance', function ($trail,$id) {
    $trail->parent('society_conveyance');
    $trail->push('NOC for Conveyance', route('dyco.conveyance_noc',$id));
});
 
//Renewal 
Breadcrumbs::for('renewal',function($trail){
    $trail->push('Home',route('renewal.index'));
});

Breadcrumbs::for('renewal_view_application', function ($trail,$id) {
    $trail->parent('renewal');
    $trail->push('View Application', route('renewal.view_application',$id));
});

Breadcrumbs::for('renewal_society_document', function ($trail,$id) {
    $trail->parent('renewal');
    $trail->push('Society Documents', route('renewal.view_documents',$id));
}); 

Breadcrumbs::for('renewal_forward_application', function ($trail,$id) {
    $trail->parent('renewal');
    $trail->push('Forward Application', route('renewal.renewal_forward_application',$id));
});

Breadcrumbs::for('renewal_architect_scrutiny', function ($trail,$id) {
    $trail->parent('renewal');
    $trail->push('Architect Scrutiny', route('renewal.architect_scrutiny',$id));
});

Breadcrumbs::for('renewal_ee_scrutiny', function ($trail,$id) {
    $trail->parent('renewal');
    $trail->push('EE Scrutiny Remark', route('renewal.ee_scrutiny',$id));
});

Breadcrumbs::for('renewal_em_scrutiny', function ($trail,$id) {
    $trail->parent('renewal');
    $trail->push('Scrutiny Remark', route('em.renewal_scrutiny_remark',$id)); 
});

Breadcrumbs::for('renewal_draft_sale_lease', function ($trail,$id) {
    $trail->parent('renewal');
    $trail->push('Lease Agreement', route('renewal.prepare_renewal_agreement',$id));
});

Breadcrumbs::for('renewal_approve_sale_lease', function ($trail,$id) {
    $trail->parent('renewal');
    $trail->push('Lease Agreement', route('renewal.approve_renewal_agreement',$id));
});

Breadcrumbs::for('renewal_stamp_lease', function ($trail,$id) {
    $trail->parent('renewal');
    $trail->push('Lease Agreement', route('renewal.stamp_renewal_agreement',$id));
});

// Society renewal
Breadcrumbs::for('society_renewal',function($trail){
    $trail->push('Home',route('society_renewal.index'));
});

Breadcrumbs::for('society_renewal_application_form', function ($trail) {
    $trail->parent('society_renewal');
    $trail->push('Application Form (Renewal)', route('society_renewal.create'));
});

Breadcrumbs::for('society_renewal_view_application', function ($trail, $id) {
    $trail->parent('society_renewal');
    $trail->push('View Application', route('society_renewal.show', $id));
});

Breadcrumbs::for('society_renewal_edit_application', function ($trail, $id) {
    $trail->parent('society_renewal');
    $trail->push('Edit Application', route('society_renewal.edit', $id));
});

Breadcrumbs::for('society_renewal_documents_upload', function ($trail) {
    $trail->parent('society_renewal');
    $trail->push('Upload documents(Renewal Application)', route('sr_upload_docs'));
});

Breadcrumbs::for('society_renewal_sale_lease', function ($trail, $id) {
    $trail->parent('society_renewal');
    $trail->push('Lease deed Agreement', route('show_lease', $id));
});

Breadcrumbs::for('society_renewal_signed_sale_lease', function ($trail, $id) {
    $trail->parent('society_renewal');
    $trail->push('Signed Lease deed Agreement', route('show_signed_lease', $id));
});


//Society Tripartite Agreement
Breadcrumbs::for('society_tripartite',function($trail){
    $trail->push('Home',route('society_offer_letter_dashboard'));
});

Breadcrumbs::for('society_tripartite_view_application', function ($trail, $id) {
    $trail->parent('society_tripartite');
    $trail->push('View Application', route('tripartite_application_form_preview', $id));
});

Breadcrumbs::for('society_tripartite_edit_application', function ($trail, $id) {
    $trail->parent('society_tripartite');
    $trail->push('Edit Application (Tripartite)', route('tripartite_application_form_edit', $id));
});

Breadcrumbs::for('society_tripartite_documents_upload', function ($trail, $id) {
    $trail->parent('society_tripartite');
    $trail->push('Upload documents (Tripartite)', route('display_tripartite_docs', $id));
});

Breadcrumbs::for('society_tripartite_agreement', function ($trail, $id) {
    $trail->parent('society_tripartite');
    $trail->push('Tripartite Agreement', route('show_tripartite_agreement', $id));
});


Breadcrumbs::for('society_tripartite_letter_for_stamp_duty', function ($trail, $id) {
    $trail->parent('society_tripartite');
    $trail->push('Tripartite Letter For Stamp Duty', route('show_tripartite_agreement', $id));
});

Breadcrumbs::for('society_tripartite_letter_for_execution_and_registration', function ($trail, $id) {
    $trail->parent('society_tripartite');
    $trail->push('Tripartite Letter For Execution and Registration', route('show_tripartite_agreement', $id));
});

//Tripartite Agreement
Breadcrumbs::for('tripartite',function($trail){
    $trail->push('Home',route('tripartite.index'));
});

Breadcrumbs::for('tripartite_view_application', function ($trail,$id) {
    $trail->parent('tripartite');
    $trail->push('View Application', route('tripartite.view_application',$id));
});

Breadcrumbs::for('tripartite_society_documents', function ($trail,$id) {
    $trail->parent('tripartite');
    $trail->push('Society Documents', route('tripartite.view_society_documents',$id));
});

Breadcrumbs::for('tripartite_agreement', function ($trail,$id) {
    $trail->parent('tripartite');
    $trail->push('Tripartite Agreement', route('tripartite.tripartite_agreement',$id));
});

Breadcrumbs::for('tripartite_note_ree', function ($trail,$id) {
    $trail->parent('tripartite');
    $trail->push('Ree Note', route('tripartite.ree_note',$id));
});

Breadcrumbs::for('ol_forward_application', function ($trail,$id) {
    $trail->parent('tripartite');
    $trail->push('Forward Application', route('tripartite.forward_application',$id));
});

Breadcrumbs::for('renewal_stamp_sign_lease', function ($trail,$id) {
    $trail->parent('society_renewal');
    $trail->push('Lease Agreement', route('renewal.stamp_sign_renewal_agreement',$id));
});


Breadcrumbs::for('admin_profile',function($trail){
    $trail->push('Profile',route('admin.profile'));
});





