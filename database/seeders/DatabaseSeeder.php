<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with realistic project management data.
     */
    public function run(): void
    {
        $password = Hash::make('password');

        $ashutosh = User::create([
            'name' => 'Ashutosh Pathak',
            'email' => 'ashutosh@example.com',
            'password' => Hash::make('Ashu@123'),
            'email_verified_at' => now(),
        ]);

        $priya = User::create([
            'name' => 'Priya Sharma',
            'email' => 'priya.sharma@example.com',
            'password' => $password,
            'email_verified_at' => now(),
        ]);

        $rahul = User::create([
            'name' => 'Rahul Mehta',
            'email' => 'rahul.mehta@example.com',
            'password' => $password,
            'email_verified_at' => now(),
        ]);

        $ananya = User::create([
            'name' => 'Ananya Iyer',
            'email' => 'ananya.iyer@example.com',
            'password' => $password,
            'email_verified_at' => now(),
        ]);

        $vikram = User::create([
            'name' => 'Vikram Singh',
            'email' => 'vikram.singh@example.com',
            'password' => $password,
            'email_verified_at' => now(),
        ]);

        $projects = [
            [
                'name' => 'Customer Portal Redesign',
                'description' => 'Rebuild the customer-facing portal with a modern UI, faster page loads, and clearer account management flows.',
                'status' => 'in_progress',
                'due_date' => now()->addMonths(2),
                'image_path' => 'https://picsum.photos/seed/portal/640/360',
                'created_by' => $ashutosh->id,
                'updated_by' => $ashutosh->id,
                'tasks' => [
                    [
                        'name' => 'Audit existing portal screens',
                        'description' => 'Review current pages, note UX pain points, and list features to keep, improve, or remove.',
                        'status' => 'completed',
                        'priority' => 'high',
                        'due_date' => now()->subWeeks(2)->toDateString(),
                        'assigned_user_id' => $priya->id,
                    ],
                    [
                        'name' => 'Design new dashboard wireframes',
                        'description' => 'Create wireframes for the account overview, invoices, and support ticket views.',
                        'status' => 'completed',
                        'priority' => 'high',
                        'due_date' => now()->subWeek()->toDateString(),
                        'assigned_user_id' => $ananya->id,
                    ],
                    [
                        'name' => 'Implement responsive navigation',
                        'description' => 'Build the top navigation and mobile menu with accessibility support.',
                        'status' => 'in_progress',
                        'priority' => 'medium',
                        'due_date' => now()->addWeeks(2)->toDateString(),
                        'assigned_user_id' => $rahul->id,
                    ],
                    [
                        'name' => 'Migrate billing history API',
                        'description' => 'Connect the new UI to the billing service and verify pagination for large account histories.',
                        'status' => 'pending',
                        'priority' => 'high',
                        'due_date' => now()->addMonth()->toDateString(),
                        'assigned_user_id' => $vikram->id,
                    ],
                    [
                        'name' => 'Run usability testing with 5 customers',
                        'description' => 'Schedule sessions, collect feedback on the prototype, and summarize recommended changes.',
                        'status' => 'pending',
                        'priority' => 'medium',
                        'due_date' => now()->addWeeks(6)->toDateString(),
                        'assigned_user_id' => $priya->id,
                    ],
                ],
            ],
            [
                'name' => 'Mobile App Launch',
                'description' => 'Ship the first public release of the iOS and Android apps with login, notifications, and offline task sync.',
                'status' => 'in_progress',
                'due_date' => now()->addMonths(3),
                'image_path' => 'https://picsum.photos/seed/mobile/640/360',
                'created_by' => $ashutosh->id,
                'updated_by' => $ashutosh->id,
                'tasks' => [
                    [
                        'name' => 'Finalize onboarding flow',
                        'description' => 'Complete screens for sign-up, email verification, and first-project setup.',
                        'status' => 'in_progress',
                        'priority' => 'high',
                        'due_date' => now()->addWeeks(1)->toDateString(),
                        'assigned_user_id' => $ananya->id,
                    ],
                    [
                        'name' => 'Set up push notification service',
                        'description' => 'Integrate FCM/APNs and add preference toggles for task assignment alerts.',
                        'status' => 'pending',
                        'priority' => 'high',
                        'due_date' => now()->addWeeks(3)->toDateString(),
                        'assigned_user_id' => $vikram->id,
                    ],
                    [
                        'name' => 'Build offline task cache',
                        'description' => 'Allow users to view and update assigned tasks while offline, then sync when online.',
                        'status' => 'pending',
                        'priority' => 'medium',
                        'due_date' => now()->addMonths(2)->toDateString(),
                        'assigned_user_id' => $rahul->id,
                    ],
                    [
                        'name' => 'Prepare App Store listing assets',
                        'description' => 'Write store copy and export screenshots for iPhone, iPad, and Android devices.',
                        'status' => 'pending',
                        'priority' => 'low',
                        'due_date' => now()->addMonths(2)->addWeeks(2)->toDateString(),
                        'assigned_user_id' => $priya->id,
                    ],
                ],
            ],
            [
                'name' => 'Q3 Marketing Website',
                'description' => 'Launch an updated marketing site with product pages, pricing, and a demo request form.',
                'status' => 'pending',
                'due_date' => now()->addMonths(4),
                'image_path' => 'https://picsum.photos/seed/marketing/640/360',
                'created_by' => $priya->id,
                'updated_by' => $priya->id,
                'tasks' => [
                    [
                        'name' => 'Write product feature copy',
                        'description' => 'Draft headlines and body copy for Projects, Tasks, and Team Collaboration pages.',
                        'status' => 'pending',
                        'priority' => 'medium',
                        'due_date' => now()->addWeeks(3)->toDateString(),
                        'assigned_user_id' => $priya->id,
                    ],
                    [
                        'name' => 'Design pricing comparison table',
                        'description' => 'Create a clear pricing layout for Free, Team, and Business plans.',
                        'status' => 'pending',
                        'priority' => 'medium',
                        'due_date' => now()->addMonth()->toDateString(),
                        'assigned_user_id' => $ananya->id,
                    ],
                    [
                        'name' => 'Build demo request form',
                        'description' => 'Add validation, spam protection, and CRM webhook delivery for demo leads.',
                        'status' => 'pending',
                        'priority' => 'high',
                        'due_date' => now()->addWeeks(5)->toDateString(),
                        'assigned_user_id' => $rahul->id,
                    ],
                ],
            ],
            [
                'name' => 'Internal HR Onboarding System',
                'description' => 'Digitize employee onboarding with document uploads, checklist tracking, and manager approvals.',
                'status' => 'completed',
                'due_date' => now()->subWeeks(3),
                'image_path' => 'https://picsum.photos/seed/hr/640/360',
                'created_by' => $vikram->id,
                'updated_by' => $vikram->id,
                'tasks' => [
                    [
                        'name' => 'Define onboarding checklist templates',
                        'description' => 'Create role-based checklists for engineering, sales, and operations hires.',
                        'status' => 'completed',
                        'priority' => 'high',
                        'due_date' => now()->subMonths(2)->toDateString(),
                        'assigned_user_id' => $priya->id,
                    ],
                    [
                        'name' => 'Add document upload workflow',
                        'description' => 'Support ID, tax, and policy acknowledgment uploads with secure storage.',
                        'status' => 'completed',
                        'priority' => 'high',
                        'due_date' => now()->subMonth()->toDateString(),
                        'assigned_user_id' => $vikram->id,
                    ],
                    [
                        'name' => 'Train managers on approval flow',
                        'description' => 'Run a short walkthrough and publish an internal how-to guide.',
                        'status' => 'completed',
                        'priority' => 'low',
                        'due_date' => now()->subWeeks(3)->toDateString(),
                        'assigned_user_id' => $ananya->id,
                    ],
                ],
            ],
            [
                'name' => 'API Performance Hardening',
                'description' => 'Improve backend response times, add caching, and reduce timeout errors under peak load.',
                'status' => 'in_progress',
                'due_date' => now()->addWeeks(6),
                'image_path' => 'https://picsum.photos/seed/api/640/360',
                'created_by' => $rahul->id,
                'updated_by' => $rahul->id,
                'tasks' => [
                    [
                        'name' => 'Profile slow database queries',
                        'description' => 'Identify the top 10 slowest endpoints and document missing indexes or N+1 queries.',
                        'status' => 'completed',
                        'priority' => 'high',
                        'due_date' => now()->subWeek()->toDateString(),
                        'assigned_user_id' => $vikram->id,
                    ],
                    [
                        'name' => 'Add Redis caching for dashboards',
                        'description' => 'Cache dashboard aggregates for 60 seconds and invalidate on task status changes.',
                        'status' => 'in_progress',
                        'priority' => 'high',
                        'due_date' => now()->addWeeks(2)->toDateString(),
                        'assigned_user_id' => $rahul->id,
                    ],
                    [
                        'name' => 'Load test with 500 concurrent users',
                        'description' => 'Run k6 scenarios for login, project list, and task update endpoints.',
                        'status' => 'pending',
                        'priority' => 'medium',
                        'due_date' => now()->addMonth()->toDateString(),
                        'assigned_user_id' => $ashutosh->id,
                    ],
                    [
                        'name' => 'Document new performance baselines',
                        'description' => 'Publish p95 latency targets and monitoring alerts for the ops team.',
                        'status' => 'pending',
                        'priority' => 'low',
                        'due_date' => now()->addWeeks(5)->toDateString(),
                        'assigned_user_id' => $priya->id,
                    ],
                ],
            ],
            [
                'name' => 'Security Compliance Review',
                'description' => 'Complete access reviews, rotate credentials, and close outstanding audit findings before the next compliance check.',
                'status' => 'pending',
                'due_date' => now()->addMonths(1),
                'image_path' => 'https://picsum.photos/seed/security/640/360',
                'created_by' => $ashutosh->id,
                'updated_by' => $ashutosh->id,
                'tasks' => [
                    [
                        'name' => 'Review admin role assignments',
                        'description' => 'Confirm only current employees have elevated access and remove unused accounts.',
                        'status' => 'in_progress',
                        'priority' => 'high',
                        'due_date' => now()->addDays(10)->toDateString(),
                        'assigned_user_id' => $ashutosh->id,
                    ],
                    [
                        'name' => 'Rotate production API keys',
                        'description' => 'Issue new keys, update secrets managers, and verify dependent services still work.',
                        'status' => 'pending',
                        'priority' => 'high',
                        'due_date' => now()->addWeeks(2)->toDateString(),
                        'assigned_user_id' => $vikram->id,
                    ],
                    [
                        'name' => 'Update incident response playbook',
                        'description' => 'Refresh contact list, escalation path, and post-incident reporting template.',
                        'status' => 'pending',
                        'priority' => 'medium',
                        'due_date' => now()->addWeeks(3)->toDateString(),
                        'assigned_user_id' => $ananya->id,
                    ],
                ],
            ],
        ];

        foreach ($projects as $projectData) {
            $tasks = $projectData['tasks'];
            unset($projectData['tasks']);

            $project = Project::create($projectData);

            foreach ($tasks as $taskData) {
                Task::create([
                    ...$taskData,
                    'image_path' => 'https://picsum.photos/seed/' . md5($taskData['name']) . '/640/360',
                    'project_id' => $project->id,
                    'created_by' => $project->created_by,
                    'updated_by' => $project->updated_by,
                ]);
            }
        }
    }
}
