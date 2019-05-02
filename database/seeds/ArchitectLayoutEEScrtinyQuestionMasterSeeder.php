<?php

use App\Layout\ArchitectLayoutEEScrtinyQuestionMaster;
use Illuminate\Database\Seeder;

class ArchitectLayoutEEScrtinyQuestionMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
            ['language_id' => 1,
                'title' => 'Plot boundary & Certified Plot as per actual measurement',
                'is_options' => 0,
                'label1' => '',
                'label2' => '',
                'rank'=>1,
                'group_in'=>''
            ],
            ['language_id' => 1,
                'title' => 'Plan showing the extension  carried out if any by the exsiting occupants and the area under the extension.',
                'is_options' => 0,
                'label1' => '',
                'label2' => '',
                'rank'=>2,
                'group_in'=>''
            ],
            ['language_id' => 1,
                'title' => 'Report regarding unauthorized work carried out if any and whether your department has regularized the same, if yes, copies of correspondence should be submitted along with.',
                'is_options' => 1,
                'label1' => 'Yes',
                'label2' => 'No',
                'rank'=>4,
                'group_in'=>''
            ],
            ['language_id' => 1,
                'title' => 'Change of user if any documentary evidence regarding NOC granted if any for the change of user.',
                'is_options' => 0,
                'label1' => '',
                'label2' => '',
                'rank'=>5,
                'group_in'=>''
            ],
            ['language_id' => 1,
                'title' => 'Requested to submit details report regarding current of existing water supply/sewage network with ref. to the layout & proposal.',
                'is_options' => 0,
                'label1' => '',
                'label2' => '',
                'rank'=>6,
                'group_in'=>''
            ],
            ['language_id' => 1,
                'title' => 'Report regarding accessibility of all the plots & also requested to inform whether the roads, D. P. reservations, Amenities, Open spaces, R.G. are handed over to MCGM or not & if yes submit receipts of this office',
                'is_options' => 1,
                'label1' => 'Yes',
                'label2' => 'No',
                'rank'=>7,
                'group_in'=>''
            ],
            ['language_id' => 1,
                'title' => 'Any other additional information relating to the development on the above referred plots & transits tenements status, any proposal of redevelopment of transit camp & turn key schemes, latest position of said scheme.',
                'is_options' => 0,
                'label1' => '',
                'label2' => '',
                'rank'=>8,
                'group_in'=>''
            ],
            // ['language_id' => 1,
            //     'title' => 'Request to demarcate the plots which are allotted under section 16/Tender with name of society.',
            //     'is_options' => 0,
            //     'label1' => '',
            //     'label2' => '',
            // ],
            ['language_id' => 1,
                'title' => 'Details of vacant land / pockets within CTS booundary',
                'is_options' => 0,
                'label1' => '',
                'label2' => '',
                'rank'=>14,
                'group_in'=>1
            ],
            ['language_id' => 1,
                'title' => 'Encroachment report.',
                'is_options' => 0,
                'label1' => '',
                'label2' => '',
                'rank'=>3,
                'group_in'=>1
            ],
            ['language_id' => 1,
                'title' => 'Demarcation as per the Layout.',
                'is_options' => 0,
                'label1' => '',
                'label2' => '',
                'rank'=>9,
                'group_in'=>1
            ],
            ['language_id' => 1,
                'title' => 'Demarcation as per the Society.',
                'is_options' => 0,
                'label1' => '',
                'label2' => '',
                'rank'=>10,
                'group_in'=>1
            ],
            ['language_id' => 1,
                'title' => 'Demarcation as per the RG/PG/G/Road.',
                'is_options' => 0,
                'label1' => '',
                'label2' => '',
                'rank'=>11,
                'group_in'=>1
            ],
            ['language_id' => 1,
                'title' => 'Demarcation as per the Amenities & Vacant residential',
                'is_options' => 0,
                'label1' => '',
                'label2' => '',
                'rank'=>12,
                'group_in'=>''
            ],
            ['language_id' => 1,
                'title' => 'Demarcation as per the Encroachment/Other.',
                'is_options' => 0,
                'label1' => '',
                'label2' => '',
                'rank'=>13,
                'group_in'=>''
            ],
        ];
        ArchitectLayoutEEScrtinyQuestionMaster::truncate();
        foreach ($questions as $question) {
            $ArchitectLayoutEEScrtinyQuestionMaster = ArchitectLayoutEEScrtinyQuestionMaster::where(['title' => $question['title']])->first();
            if ($ArchitectLayoutEEScrtinyQuestionMaster) {

            } else {
                $ArchitectLayoutEEScrtinyQuestionMaster = new ArchitectLayoutEEScrtinyQuestionMaster;
                $ArchitectLayoutEEScrtinyQuestionMaster->language_id = $question['language_id'];
                $ArchitectLayoutEEScrtinyQuestionMaster->title = $question['title'];
                $ArchitectLayoutEEScrtinyQuestionMaster->is_options = $question['is_options'];
                $ArchitectLayoutEEScrtinyQuestionMaster->label1 = $question['label1'];
                $ArchitectLayoutEEScrtinyQuestionMaster->label2 = $question['label2'];
                $ArchitectLayoutEEScrtinyQuestionMaster->rank = $question['rank'];
                $ArchitectLayoutEEScrtinyQuestionMaster->group_in = $question['group_in'];
                $ArchitectLayoutEEScrtinyQuestionMaster->save();
            }

        }
    }
}
