<?php
/*
Template Name: Transparency Page
*/
get_header();
?>

<div><?php pageBanner(); ?></div>
<?php the_breadcrumbs(); ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Transparency Seal Section -->
    <div
        class="rounded-lg border bg-card text-card-foreground shadow-sm hover:shadow-lg transition-shadow duration-300 mb-8">
        <div class="flex flex-col lg:flex-row items-center gap-8 p-6">
            <div class="flex-shrink-0">
                <div
                    class="w-32 h-32 lg:w-40 lg:h-40 bg-gradient-to-br from-primary-50 to-primary-100 rounded-full flex items-center justify-center shadow-lg">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR9SKvRPjCLHuewuaJb55kZr3_hDwrfJkLqvQ&s"
                        alt="Seal of Transparency" class="w-24 h-24 lg:w-32 lg:h-32 object-contain" />
                </div>
            </div>
            <div class="flex-1 text-center lg:text-left">
                <h2 class="text-2xl lg:text-3xl font-bold text-gray-800 mb-4">
                    Committed to Transparency
                </h2>
                <p class="text-gray-600 leading-relaxed text-lg">
                    We are dedicated to maintaining the highest standards of transparency and accountability
                    in all our operations. Our commitment to open governance ensures that citizens have
                    access to information about how their government operates and how public resources are utilized.
                </p>
            </div>
        </div>
    </div>

    <!-- Transparency Categories Section -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Transparency Categories</h2>
        <p class="text-gray-600 mb-6">Organized access to public information and reports</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <?php
            $transparency_areas = array(
                array(
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-primary-600"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>',
                    'title' => "Budget & Finance",
                    'description' => "Access annual budgets, financial reports, and expenditure details",
                    'count' => "12 documents"
                ),
                array(
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-primary-600"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><circle cx="8" cy="6" r="1"></circle><circle cx="8" cy="10" r="1"></circle><circle cx="8" cy="14" r="1"></circle><circle cx="8" cy="18" r="1"></circle><line x1="16" y1="10" x2="12" y2="10"></line><line x1="16" y1="14" x2="12" y2="14"></line><line x1="16" y1="18" x2="12" y2="18"></line></svg>',
                    'title' => "Bids & Awards",
                    'description' => "Procurement notices, bidding results, and contract awards",
                    'count' => "8 documents"
                ),
                array(
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-primary-600"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>',
                    'title' => "FOI Requests",
                    'description' => "Freedom of Information manual and request procedures",
                    'count' => "5 documents"
                ),
                array(
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-primary-600"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>',
                    'title' => "Reports & Audits",
                    'description' => "Performance reports, audit findings, and compliance documents",
                    'count' => "15 documents"
                )
            );

            foreach ($transparency_areas as $area) {
                echo '
                <div class="border bg-white rounded-lg shadow-sm hover:shadow-lg transition-shadow duration-300 cursor-pointer">
                
                    <div class="p-6">
                        <div class="flex items-center space-x-4 mb-4">
                            ' . $area['icon'] . '
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">' . $area['title'] . '</h3>
                                <p class="text-sm text-primary-600">' . $area['count'] . '</p>
                            </div>
                        </div>
                        <p class="text-gray-600">' . $area['description'] . '</p>
                    </div>
                </div>';
            }
            ?>
        </div>
    </section>

    <!-- Recent Documents Section -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Recent Documents</h2>
        <p class="text-gray-600 mb-6">Latest transparency reports and public documents</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php
            $documents = array(
                array(
                    'title' => "Annual Budget Report 2024",
                    'description' => "Comprehensive financial report outlining municipal budget allocation and expenditures for fiscal year 2024.",
                    'fileType' => "PDF",
                    'fileSize' => "2.5 MB",
                    'date' => "Dec 1, 2024",
                    'type' => "Budget",
                    'downloadUrl' => "#"
                ),
                array(
                    'title' => "Full Disclosure Report Q3 2024",
                    'description' => "Quarterly transparency report including executive compensation and major expenditures.",
                    'fileType' => "PDF",
                    'fileSize' => "1.8 MB",
                    'date' => "Nov 30, 2024",
                    'type' => "Disclosure",
                    'downloadUrl' => "#"
                ),
                array(
                    'title' => "Procurement Plan 2025",
                    'type' => "Procurement Plan",
                    'description' => "Annual procurement plan detailing planned purchases and bidding schedules for the upcoming year.",
                    'fileType' => "PDF",
                    'fileSize' => "3.2 MB",
                    'date' => "Nov 25, 2024",
                    'downloadUrl' => "#"
                ),
            );
                foreach ($documents as $doc) {
                    get_template_part('template-parts/cards/issuance-card', null, ['issuance' => $doc]);
                }
            ?>
        </div>
    </section>

    <!-- Official Issuances Section -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Official Issuances</h2>
        <p class="text-gray-600 mb-6">Local laws, orders, and resolutions enacted by the municipality</p>

                <!-- Issuance Types Navigation -->
        <div class="flex flex-wrap gap-2 mb-6">
            <a href="#ordinances" class="px-4 py-2 bg-primary-100 text-primary-800 rounded-full text-sm font-medium hover:bg-primary-200 transition-colors">Ordinances</a>
            <a href="#executive-orders" class="px-4 py-2 bg-primary-100 text-primary-800 rounded-full text-sm font-medium hover:bg-primary-200 transition-colors">Executive Orders</a>
            <a href="#resolutions" class="px-4 py-2 bg-primary-100 text-primary-800 rounded-full text-sm font-medium hover:bg-primary-200 transition-colors">Resolutions</a>
            <a href="#memoranda" class="px-4 py-2 bg-primary-100 text-primary-800 rounded-full text-sm font-medium hover:bg-primary-200 transition-colors">Memoranda</a>
            <a href="#proclamations" class="px-4 py-2 bg-primary-100 text-primary-800 rounded-full text-sm font-medium hover:bg-primary-200 transition-colors">Proclamations</a>
        </div>

         <!-- Ordinances Subsection -->
        <div id="ordinances" class="mb-8">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <?php echo get_service_icon_svg('gavel', 'text-primary-600 w-6 h-6'); ?>
                Ordinances
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php
                $ordinances = [
                    [
                        'title' => 'Ordinance No. 2024-001',
                        'type' => 'Ordinance',
                        'description' => 'Regulating the operation of businesses within the municipality.',
                        'fileType' => 'PDF',
                        'fileSize' => '1.2 MB',
                        'date' => 'Jan 15, 2024',
                        'downloadUrl' => '#'
                    ],
                    [
                        'title' => 'Ordinance No. 2023-012',
                        'type' => 'Ordinance',
                        'description' => 'Amending the municipal revenue code for fiscal year 2024.',
                        'fileType' => 'PDF',
                        'fileSize' => '2.1 MB',
                        'date' => 'Dec 5, 2023',
                        'downloadUrl' => '#'
                    ]
                ];
                
                foreach ($ordinances as $issuance) {
                    get_template_part('template-parts/cards/issuance-card', null, ['issuance' => $issuance]);
                }
                ?>
            </div>
        </div>

        <!-- Proclamations Subsection -->
        <div id="proclamations" class="mb-8">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <?php echo get_service_icon_svg('award', 'w-6 h-6'); ?>
                Public Proclamations
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php
                $proclamations = [
                    [
                        'title' => 'Proclamation No. 2024-001',
                        'type' => 'Proclamation',
                        'description' => 'Declaring March 15 as Municipal Arbor Day.',
                        'fileType' => 'PDF',
                        'fileSize' => '580 KB',
                        'date' => 'Jan 20, 2024',
                        'downloadUrl' => '#'
                    ]
                ];
                
                foreach ($proclamations as $issuance) {
                    get_template_part('template-parts/cards/issuance-card', null, ['issuance' => $issuance]);
                }
                ?>
            </div>
        </div>
    </section>




    <!-- Enhanced Freedom of Information Section -->
    <section class="bg-gradient-to-r from-primary-50 to-indigo-50 rounded-lg shadow-md p-6 mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Freedom of Information (FOI)</h2>
        <p class="text-gray-600 mb-6">Your constitutional right to access public information</p>

        <div class="space-y-8">
            <?php 
            get_template_part('template-parts/sections/transparency-seal');
            get_template_part('template-parts/sections/transparency-hri');
            get_template_part('template-parts/sections/transparency-foi');
            ?>   
        </div>
    </section>
</div>

<?php get_footer(); ?>