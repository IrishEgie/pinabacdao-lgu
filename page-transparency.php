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
                    'uploadDate' => "Dec 1, 2024",
                    'category' => "Budget",
                    'downloadUrl' => "#"
                ),
                array(
                    'title' => "Full Disclosure Report Q3 2024",
                    'description' => "Quarterly transparency report including executive compensation and major expenditures.",
                    'fileType' => "PDF",
                    'fileSize' => "1.8 MB",
                    'uploadDate' => "Nov 30, 2024",
                    'category' => "Disclosure",
                    'downloadUrl' => "#"
                ),
                array(
                    'title' => "Procurement Plan 2025",
                    'description' => "Annual procurement plan detailing planned purchases and bidding schedules for the upcoming year.",
                    'fileType' => "PDF",
                    'fileSize' => "3.2 MB",
                    'uploadDate' => "Nov 25, 2024",
                    'category' => "Procurement",
                    'downloadUrl' => "#"
                ),
                array(
                    'title' => "COA Audit Report 2023",
                    'description' => "Commission on Audit report highlighting financial compliance and recommendations.",
                    'fileType' => "PDF",
                    'fileSize' => "4.1 MB",
                    'uploadDate' => "Nov 20, 2024",
                    'category' => "Audit",
                    'downloadUrl' => "#"
                ),
                array(
                    'title' => "Citizens Charter",
                    'description' => "Official document outlining services, requirements, and processing times for citizen transactions.",
                    'fileType' => "PDF",
                    'fileSize' => "1.2 MB",
                    'uploadDate' => "Nov 15, 2024",
                    'category' => "Charter",
                    'downloadUrl' => "#"
                ),
                array(
                    'title' => "Performance Scorecard 2024",
                    'description' => "Municipal performance indicators and achievements for the current fiscal year.",
                    'fileType' => "PDF",
                    'fileSize' => "900 KB",
                    'uploadDate' => "Nov 10, 2024",
                    'category' => "Performance",
                    'downloadUrl' => "#"
                )
            );

            foreach ($documents as $doc) {
                ?>
                <div
                    class="group hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 bg-white rounded-lg border border-gray-200 overflow-hidden">
                    <div class="p-6 pb-4">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="p-2 bg-primary-50 rounded-lg group-hover:bg-primary-100 transition-colors duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="text-primary-600">
                                        <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z">
                                        </path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </div>
                                <div>
                                    <h3
                                        class="text-lg font-semibold text-gray-800 group-hover:text-primary-500 transition-colors duration-300">
                                        <?php echo esc_html($doc['title']); ?>
                                    </h3>
                                    <span
                                        class="mt-1 inline-flex items-center rounded-md border border-gray-200 px-2.5 py-0.5 text-xs font-medium">
                                        <?php echo esc_html($doc['category']); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="px-6 pb-6 space-y-4">
                        <p class="text-gray-600 text-sm leading-relaxed">
                            <?php echo esc_html($doc['description']); ?>
                        </p>

                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <div class="flex items-center space-x-4">
                                <span class="font-medium"><?php echo esc_html($doc['fileType']); ?></span>
                                <span><?php echo esc_html($doc['fileSize']); ?></span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                <span><?php echo esc_html($doc['uploadDate']); ?></span>
                            </div>
                        </div>

                        <button
                            class="w-full group-hover:bg-primary-500 transition-colors duration-300 bg-primary-600 text-white py-2 px-4 rounded-md inline-flex items-center justify-center"
                            onclick="window.open('<?php echo esc_url($doc['downloadUrl']); ?>', '_blank')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="mr-2">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="7 10 12 15 17 10"></polyline>
                                <line x1="12" y1="15" x2="12" y2="3"></line>
                            </svg>
                            Download
                        </button>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </section>

    <!-- Enhanced Freedom of Information Section -->
    <section class="bg-gradient-to-r from-primary-50 to-indigo-50 rounded-lg shadow-md p-6 mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Freedom of Information (FOI)</h2>
        <p class="text-gray-600 mb-6">Your constitutional right to access public information</p>

        <div class="space-y-8">
            <!-- FOI Header with Logo -->
            <div class="flex flex-col lg:flex-row items-center gap-6 pb-6 border-b border-gray-200">
                <div class="flex-shrink-0">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRmCw_tEL7mZ_1uYstlYfr362dO1VSZ38ypUA&s"
                        alt="Freedom of Information Logo" class="w-20 h-20 object-contain" />
                </div>
                <div class="flex-1 text-center lg:text-left">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Access to Information</h3>
                    <p class="text-gray-600">
                        Every Filipino has the right to information on matters of public concern.
                        The FOI ensures transparency and accountability in government operations.
                    </p>
                </div>
            </div>

            <!-- How to Request Information -->
            <div>
                <h4 class="text-xl font-semibold mb-4 text-gray-800">How to Request Information</h4>
                <div class="grid lg:grid-cols-2 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow-md border-l-4 border-l-primary-600 group-hover:text-primary-500 transition-colors duration-300">
                        <div class="p-6">
                            <h5 class="text-lg font-semibold flex items-center gap-2 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="w-5 h-5 text-primary-600">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                Online Request
                            </h5>
                            <p class="text-gray-600 mb-4">
                                Submit your FOI request through the official government portal for faster processing.
                            </p>
                            <button
                                class="w-full bg-primary-600 hover:bg-primary-700 text-white py-2 px-4 rounded-md transition-colors duration-300">
                                Visit FOI.gov.ph
                            </button>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md border-l-4 border-l-green-600">
                        <div class="p-6">
                            <h5 class="text-lg font-semibold flex items-center gap-2 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="w-5 h-5 text-green-600">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                Walk-in Request
                            </h5>
                            <p class="text-gray-600 mb-4">
                                Visit our office with proper identification and completed request form.
                            </p>
                            <button
                                class="w-full border border-green-600 text-green-600 hover:bg-green-50 py-2 px-4 rounded-md transition-colors duration-300">
                                Download Form
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Request Requirements -->
            <div>
                <h4 class="text-lg font-semibold mb-4 text-gray-800">Request Requirements</h4>
                <div class="bg-white rounded-lg p-6 border border-gray-200">
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-start gap-3">
                            <div class="w-2 h-2 bg-primary-600 rounded-full mt-2 flex-shrink-0"></div>
                            <span>Completed FOI Request Form (downloadable from our website)</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="w-2 h-2 bg-primary-600 rounded-full mt-2 flex-shrink-0"></div>
                            <span>Valid government-issued ID (for walk-in requests)</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="w-2 h-2 bg-primary-600 rounded-full mt-2 flex-shrink-0"></div>
                            <span>Clear description of the information requested</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="w-2 h-2 bg-primary-600 rounded-full mt-2 flex-shrink-0"></div>
                            <span>Purpose of the information request (optional but recommended)</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Processing Timeline -->
            <div>
                <h4 class="text-lg font-semibold mb-4 text-gray-800">Processing Timeline</h4>
                <div class="bg-amber-50 border border-amber-200 rounded-lg p-6">
                    <div class="flex items-center gap-3 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="w-5 h-5 text-amber-600">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        <span class="font-medium text-amber-800">Standard Processing Time</span>
                    </div>
                    <p class="text-amber-700 mb-4">
                        FOI requests are processed within <strong>15 working days</strong> from receipt of complete
                        requirements.
                    </p>
                    <p class="text-sm text-amber-600">
                        Complex requests may require additional time. You will be notified if an extension is needed.
                    </p>
                </div>
            </div>

            <!-- Contact Information -->
            <div>
                <h4 class="text-lg font-semibold mb-4 text-gray-800">FOI Contact Information</h4>
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-lg shadow-md text-center">
                        <div class="p-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="w-8 h-8 text-primary-600 mx-auto mb-3">
                                <path
                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                </path>
                            </svg>
                            <h5 class="font-semibold mb-2">Phone</h5>
                            <p class="text-gray-600">+63 (55) 123-4567</p>
                            <p class="text-sm text-gray-500">FOI Hotline</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md text-center">
                        <div class="p-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="w-8 h-8 text-primary-600 mx-auto mb-3">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                </path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                            <h5 class="font-semibold mb-2">Email</h5>
                            <p class="text-gray-600">foi@pinabacdao.gov.ph</p>
                            <p class="text-sm text-gray-500">FOI Officer</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md text-center">
                        <div class="p-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="w-8 h-8 text-primary-600 mx-auto mb-3">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <h5 class="font-semibold mb-2">Office</h5>
                            <p class="text-gray-600">Municipal Hall</p>
                            <p class="text-sm text-gray-500">2nd Floor, Room 205</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FOI Officer -->
            <div class="bg-primary-50 rounded-lg p-6 border border-primary-200">
                <h4 class="text-lg font-semibold mb-3 text-primary-800">Designated FOI Officer</h4>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-primary-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold">JD</span>
                    </div>
                    <div>
                        <p class="font-medium text-primary-800">Juan Dela Cruz</p>
                        <p class="text-primary-600">FOI Receiving Officer</p>
                        <p class="text-sm text-primary-500">Available Mon-Fri, 8:00 AM - 5:00 PM</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>