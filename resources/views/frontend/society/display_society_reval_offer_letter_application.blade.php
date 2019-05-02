<div id="printdiv">
    <div style="font-size: 18px;">
        <div>
            <div style="text-align: center;">
                <!-- <h3 style="font-weight: bold; margin-top: 5px; margin-bottom: 5px;">अर्जाचा नमुना</h3> -->
            </div>
            <div>
                <p>
                    <p style="display: block; font-weight: bold; line-height: 0; margin-top: 5px; margin-bottom: 5px;">प्रति,</p>
                    <table style="margin-left: -5px; margin-top: 5px; margin-bottom: 5px;">
                        <tbody>
                            <tr>
                                <td style="font-size: 18px;">कार्यकारी अभियंता,</td>
                                <td style="border-bottom: 1px solid #000; font-size: 18px;">REE</td>
                                <td style="font-size: 18px;">विभाग,</td>
                            </tr>
                        </tbody>
                    </table>
                    <p style="display: block; margin-top: 5px; margin-bottom: 5px;">मुंबई गृहनिर्माण व क्षेत्रविकास मंडळ,</p>
                    <p style="display: block; margin-top: 5px; margin-bottom: 5px;">गृहनिर्माण भवन, वांद्रे (पुर्व),</p>
                    <p style="display: block; margin-top: 5px; margin-bottom: 5px;">मुंबई - ४०००५१.</p>
                </p>
            </div>
        </div>
        <div>
            <div style="line-height: 1.5;">

                <p><span class="font-weight-semi-bold"> Subject - </span>Proposed redevelopment to the existing Building No. <input type="hidden" name="application_master_id" value="{{ $id }}" readonly>{{ $society_details->building_no }} (address ) {{ $society_details->address }} (society name) {{ $society_details->name }}

                <p class="font-weight-semi-bold">Ref: Society's request letter submitted on {{ date(config('commanConfig.dateFormat'), strtotime($old_ol_application->submitted_at )) }}</p>

                <p class="font-weight-semi-bold">Sir,</p>
                <p>
                    With reference to above subject, MHADA have issued offer letter vide no {{ $ol_application->request_form->ol_vide_no }} dated {{ date(config('commanConfig.dateFormat'), strtotime($ol_application->request_form->ol_issue_date)) }}. for additional biltup area. We request you to consider our request for extension of the offer letter period for further six months as per policy of MHADA.
                </p>

                <p> <span>Revalidation Reason: </span>

                        {{ $ol_application->request_form->reason_for_revalidation }}
                </p>
                <p>
                    It is also understood that, MHADA has passed a Resolution No. {{ $ol_application->request_form->resolution_no }} dated {{ date(config('commanConfig.dateFormat'), strtotime($ol_application->request_form->date_of_meeting)) }} for allowing Co-operative Housing Societies to pay the amount of premium for additional Build-up area in three equal installments over a period of two years. We are ready to pay interest as per policy of MHADA.
                </p>

                <p>
                    Kindly, consider our sufferings & hardships and support our redevelopment by providing us received offer letter on the broad terms as requested above.

                    Thinking you in kind anticipation.
                </p>


            </div>
            <div style="margin-top: 30px;">
                <div style="float: right; text-align: right;">
                    <p style="margin-top: 0; margin-bottom: 60px;">आपला विश्वासू</p>
                        <p style="display: block; margin-top: 5px; margin-bottom: 5px;">अध्यक्ष / सचिव / खजिनदार</p>
                        <p style="display: block; margin-top: 5px; margin-bottom: 5px;">------- स.गृ.नि. संस्था मर्या.</p>
                </div>
            </div>
        </div>
    </div>
</div>