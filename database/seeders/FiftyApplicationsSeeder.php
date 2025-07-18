<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Application;
use App\Models\ApplicantTypeApplications;
use App\Models\ApplicationFiles;
use App\Models\Approval;
use Illuminate\Support\Str;
use App\Constants\Roles;


class FiftyApplicationsSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i < 50; $i++) {
            // Generate application number based on latest ID
            $nextId = $i + 1;
            $applicationNumber = 'APP' . str_pad($nextId, 5, '0', STR_PAD_LEFT);

            // Create application instance without virtual attributes
            $application = Application::factory()->make();
            $application->setAppends([]); // Prevent 'current_approver_role' from being included
            $application->application_number = $applicationNumber;

            // Save to DB using only real attributes
            $createdApp = Application::create($application->getAttributes());

            // Applicant types
            foreach (range(1, rand(1, 3)) as $typeId) {
                ApplicantTypeApplications::create([
                    'application_id' => $createdApp->id,
                    'applicant_type_id' => $typeId,
                ]);
            }

            // Files
            $folder = Str::slug($createdApp->business_name);
            $files = [
                'proof_of_capitalization',
                'barangay_clearance',
                'birth_certificate_or_id',
                'ncip_document',
                'fpic_certification',
                'business_permit',
                'authorization_letter',
                'sapa_application_form',
            ];

            foreach ($files as $file) {
                ApplicationFiles::create([
                    'application_id' => $createdApp->id,
                    'name' => $file,
                    'file_name' => "{$file}.pdf",
                    'file_size' => rand(100000, 500000),
                    'file_type' => 'application/pdf',
                    'file_path' => "application_files/{$folder}/{$file}.pdf",
                ]);
            }

            // Initial approval
            Approval::create([
                'application_id' => $createdApp->id,
                'user_id' => null,
                'approving_role' => Roles::RPS_TEAM,
                'status' => 'pending',
            ]);
        }


    }
}


//run php artisan db:seed --class=FiftyApplicationsSeeder
