<?php
use yii\helpers\Url;

$this->title = $meta['title'];
$this->registerMetaTag(array("name"=>"description","content"=>$meta['description']));
$this->registerMetaTag(array("name"=>"keywords","content"=>$meta['keyword']));
?>
<div class="split"></div>
<div class="container">
    <div class="container-bg terms-bar">
        <ul id="deal-detal-tab" class="nav nav-tabs terms-nav">
            <li class="active" id="terms-tab"><a href="#terms" data-toggle="tab" aria-expanded="false">Terms</a></li>
            <li id="privacy-tab"><a href="#privacy" data-toggle="tab" aria-expanded="true">Privacy</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" id="terms">
                <div class="tabbable">
                    <ul class="account-menu-list account-menu-container" id="divstyletab">
                        <li class="active"><a href="#term-1" class="account-menu-a">1. Terms Overview</a></li>
                        <li><a href="#term-2" class="account-menu-a">2. Use License</a></li>
                        <li><a href="#term-3" class="account-menu-a">3. Disclaimer</a></li>
                        <li><a href="#term-4" class="account-menu-a">4. Deals Policy</a></li>
                        <li><a href="#term-5" class="account-menu-a">5. Limitations</a></li>
                        <li><a href="#term-6" class="account-menu-a">6. Accuracy of Materials</a></li>
                        <li><a href="#term-7" class="account-menu-a">7. Links</a></li>
                        <li><a href="#term-8" class="account-menu-a">8. Modifications</a></li>
                        <li><a href="#term-9" class="account-menu-a">9. Governing Law</a></li>
                    </ul>
                    <div class="account-content-container tab-content-container">
                        <div class="term-entry" id="term-1">
                            <p class="term-min-title">1. Terms Overview</p>
                            <p class="term-content">By accessing the website at http://www.theclubofcashback.com, you are agreeing to be bound by these terms of service, all applicable laws and regulations, and agree that you are responsible for compliance with any applicable local laws.</p>
                            <p class="term-content">If you do not agree with any of these terms, you are prohibited from using or accessing this site. The materials contained in this website are protected by applicable copyright and trademark law.</p>
                        </div>

                        <div class="term-entry" id="term-2">
                            <p class="term-min-title">2. Use License</p>
                            <p class="term-content">Permission is granted to temporarily download one copy of the materials (information or software) on CashBackClub’s website for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title.<br>under this license <b style="font-weight: 700;">you may not</b>:</p>
                            <ul style="color: #3366FF;">
                                <li>• Modify or copy the materials;</li>
                                <li>• Use the materials for any commercial purpose, or for any public display (commercial or non-commercial);</li>
                                <li>• Attempt to decompile or reverse engineer any software contained on CashBackClub’s website;</li>
                                <li>• Remove any copyright or other proprietary notations from the materials; or</li>
                                <li>• Transfer the materials to another person or “mirror” the materials on any other server.</li>
                            </ul>
                            <p class="term-content">This license shall automatically terminate if you violate any of these restrictions and may be terminated by CashBackClub at any time. Upon terminating your viewing of these materials or upon the termination of this license, you must destroy any downloaded materials in your possession whether in electronic or printed format.</p>
                        </div>

                        <div class="term-entry" id="term-3">
                            <p class="term-min-title">3. Disclaimer</p>
                            <p class="term-content">The materials on CashBackClub’s website are provided on an ‘as is’ basis. CashBackClub makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties including, without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights.</p>
                            <p class="term-content">Further, CashBackClub does not warrant or make any representations concerning the accuracy, likely results, or reliability of the use of the materials on its website or otherwise relating to such materials or on any sites linked to this site.</p>
                        </div>

                        <div class="term-entry" id="term-4">
                            <p class="term-min-title">4. Deals Policy</p>
                            <p class="term-content">Deals within CashBackClub are available only to registered users. Only one account is allowed per user. CashBackClub reserves the right to restrict or terminate your account if CashBackClub has sufficient reason to believe that deals were acquired through unauthorized means.</p>
                            <p class="term-content"></p>
                        </div>

                        <div class="term-entry" id="term-5">
                            <p class="term-min-title">5. Limitations</p>
                            <p class="term-content">In no event shall CashBackClub or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption) arising out of the use or inability to use the materials on CashBackClub’s website, even if CashBackClub or a CashBackClub authorized representative has been notified orally or in writing of the possibility of such damage. Because some jurisdictions do not allow limitations on implied warranties, or limitations of liability for consequential or incidental damages, these limitations may not apply to you.</p>
                        </div>

                        <div class="term-entry" id="term-6">
                            <p class="term-min-title">6. Accuracy of Materials</p>
                            <p class="term-content">The materials appearing on CashBackClub’s website could include technical, typographical, or photographic errors. CashBackClub does not warrant that any of the materials on its website are accurate, complete or current. CashBackClub may make changes to the materials contained on its website at any time without notice. However CashBackClub does not make any commitment to update the materials.</p>
                        </div>

                        <div class="term-entry" id="term-7">
                            <p class="term-min-title">7. Links</p>
                            <p class="term-content">CashBackClub has not reviewed all of the sites linked to its website and is not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by CashBackClub of the site. Use of any such linked website is at the user’s own risk.</p>
                        </div>

                        <div class="term-entry" id="term-8">
                            <p class="term-min-title">8. Modifications</p>
                            <p class="term-content">CashBackClub may revise these terms of service for its website at any time without notice. By using this website you are agreeing to be bound by the then current version of these terms of service.</p>
                        </div>

                        <div class="term-entry" id="term-9">
                            <p class="term-min-title">9. Governing Law</p>
                            <p class="term-content">These terms and conditions are governed by and construed in accordance with the laws of United States and you irrevocably submit to the exclusive jurisdiction of the courts in that State or location.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane active" id="privacy">
                <div class="tabbable">
                    <ul class="account-menu-list account-menu-container" id="divstyletab">
                        <li class="active"><a href="#privacy-1" class="account-menu-a">1. Policy Overview</a></li>
                        <li><a href="#privacy-2" class="account-menu-a">2. Information  We Collect</a></li>
                        <li><a href="#privacy-3" class="account-menu-a">3. Use of Informaiton</a></li>
                        <li><a href="#privacy-4" class="account-menu-a">4. Sharing Your Information</a></li>
                        <li><a href="#privacy-5" class="account-menu-a">5. Your Privacy Controls</a></li>
                        <li><a href="#privacy-6" class="account-menu-a">6. Security Measures</a></li>
                        <li><a href="#privacy-7" class="account-menu-a">7. About This Policy</a></li>
                    </ul>
                    <div class="account-content-container tab-content-container">
                        <div class="term-entry" id="privacy-1">
                            <p class="term-min-title">1. Policy Overview</p>
                            <p class="term-content">Welcome to www.theclubofcashback.com. This Privacy Policy is provided to inform you of our policies and practices regarding the collection, use, and disclosure of information about you.</p>
                            <p class="term-content">www.theclubofcashback.com (“CashBackClub”, “we,” “us” or “our”) is committed to respecting the privacy rights and concerns of all users of the www.theclubofcashback.com website where this Privacy Policy is posted (the “Site”) (we refer to the Site and the services made available through the Site, collectively, as “CashBackClub Features”). As such, we have established and implemented this Privacy Policy to inform visitors to the Site and users of the CashBackClub Features how we use and protect the information we collect through the Site and CashBackClub Features.</p>
                            <p class="term-content">By visiting the Site or using any of the CashBackClub Features, you consent to CashBackClub’s collection, use, storage, deletion and disclosure of information relating to you as set forth in this Privacy Policy. This Privacy Policy is effective as of the date set forth above and is only applicable to the Site and not to any other website that you may be able to access from the Site which may have its own data collection and use practices and policies.</p>
                        </div>

                        <div class="term-entry" id="privacy-2">
                            <p class="term-min-title">2. What information do we collect?</p>
                            <p class="term-content">
                                <span style="color:#3366FF;">PERSONAL INFORMATION</span><br>
                                Personal information means information that can be used to identify and contact you. You need to submit personal information to access certain aspects of the Site and the CashBackClub Features.
                            </p>
                            <p class="term-content">We collect personal information when you participate in feedback forms, questionnaires, contests or sweepstakes; purchase a product through the CashBackClub Features; receive customer or technical support;utilizing the Site and CashBackClub Features;registering products through the Site. <br>The informaiton we collect including:</p>
                            <ul>
                                <li>● name</li>
                                <li>● address</li>
                                <li>● email address</li>
                                <li>● telephone number</li>
                                <li>● products you purchased</li>
                                <li>● where you purchased your products</li>
                            </ul>
                            <p class="term-content">
                                <span style="color:#3366FF;">COOKIES</span><br>
                                “Cookies” are small bits of electronic information that a website sends to a visitor’s browser and are stored on the visitor’s hard drive. Like many websites, we employ cookies in certain areas of the Site to allow us to provide information to make your online experience more convenient. For example, when you return to the Site after logging in, cookies provide information to the Site so that the Site will remember who you are on subsequent visits, speeding up or enhancing your experience of the CashBackClub Features by, for instance, tailoring content to you. Cookies also prevent items placed in a shopping basket from disappearing by the time you checkout.
                            </p>
                            <p class="term-content">
                                <span style="color:#3366FF;">LOG INFORMATION</span><br>
                                Our servers automatically record information that your browser sends whenever you visit the Site. This information includes your Internet Protocol address, your browser type and version, the search engine you used to find the CashBackClub Features, if any, which CashBackClub Features you use and when and how long you use them. We use this information to monitor and analyze how users use the CashBackClub Features, to provide customer service and to maintain and improve the CashBackClub Features.
                            </p>
                            <p class="term-content">
                                <span style="color:#3366FF;">CHILDREN’S PRIVACY</span><br>
                                We do not knowingly collect personal information from children under 13. We take children’s privacy seriously, and encourage parents to play an active role in their children’s online experience at all times.
                            </p>
                        </div>

                        <div class="term-entry" id="privacy-3">
                            <p class="term-min-title">3. How do we use the information</p>
                            <p class="term-content">The personal information you provide to us will allow us to fulfill any product or service orders; alert you of new products or services, features, or enhancements; handle your customer service questions or issues; administer promotions, contests and sweepstakes; and notify you of promotions, updates, or special offers that we think may interest you. We also use your email address and phone number as part of the CashBackClub Features in sending you messages about the CashBackClub Features and other general announcements.</p>
                            <p class="term-content">We keep track of your interactions with us, including but not limited to your activity within the CashBackClub Features. We may use personal information that you provide to us to send messages to you in response to your request to perform an activity in connection with your use of any of the CashBackClub Features. We may also use your personal information to contact you when necessary.</p>
                            <p class="term-content">We may use your personal information with non-personal information that we have collected in a manner such that the end-product does not personally identify you or any other user of the CashBackClub Features. We may make your personal information non-personally identifiable by either combining it with information about other users (aggregating your personal information with information about other users), or by removing characteristics (such as your name or email address) that make the information personally identifiable. This process is known as de-personalizing your information.</p>
                            <p class="term-content">You grant us a royalty-free, worldwide, perpetual, irrevocable and fully transferable right and license to use your personal information in connection with the creation and development of analytical and statistical analysis tools relating to the use of the customer data we collect in providing the CashBackClub Features (the Analytical Data). We are expressly authorized to make any commercial use of the Analytical Data, including without limitation, sharing the Analytical Data with third parties, provided that we do not sell, trade, or otherwise transfer from us any part of the Analytical Data that personally identifies any CashBackClub Features users.</p>
                        </div>

                        <div class="term-entry" id="privacy-4">
                            <p class="term-min-title">4. Will we share your personal information with third parties?</p>
                            <p class="term-content">
                                <span style="color:#3366FF;">SHARING OF INFORMATION</span><br>
                                We use your personal information to complete transactions, respond to your requests, deliver products and services you request, and send communications to you about promotions, updates, or special offers (which may be offered by CashBackClub or one of its business partners) that may be of interest to you. We may also use your personal information to provide analyses of our users in the aggregate (including Analytical Data subject to the terms of this Privacy Policy) to prospective partners and other third parties. In addition, we will share the personal information we collect from you under the following circumstances:
                            </p>
                            <p class="term-content">
                                <span style="color:#3366FF;">PROTECTION OF RIGHTS</span><br>
                                We will share personal information if we have a good faith belief that (i) access, use, preservation or disclosure of such information is reasonably necessary to satisfy any applicable law, regulation, legal process, such as a court order or subpoena, or a request by law enforcement or governmental authorities, (ii) such action is appropriate to enforce our Terms of Use for the CashBackClub Features, including any investigation of potential violations thereof, (iii) such action is necessary to detect, prevent, or otherwise address fraud, security or technical issues associated with the CashBackClub Features, or (iv) such action is appropriate to protect the rights, property or safety of CashBackClub, its employees, users of the CashBackClub Features or others.
                            </p>
                            <p class="term-content">
                                <span style="color:#3366FF;">ASSET TRANSFERS</span><br>
                                If we become involved in a merger, acquisition or other transaction involving the sale of some or all of CashBackClub’s assets, user information, including personal information collected from you through your use of the CashBackClub Features, could be included in the transferred assets. Should such an event occur, we will use reasonable means to notify you through email and/or a prominent notice on the Site.
                            </p>
                            <p class="term-content">
                                <span style="color:#3366FF;">SERVICE PROVIDERS</span><br>
                                We may share your personal information with service providers that we engage for the purpose of processing information on our and your behalf. For example, we may partner with other companies to process payments for the CashBackClub Features. Additionally, we may partner with other companies to process, analyze, and/or store data, including, but not limited to, Analytical Data. While providing services for us, these companies may access your personal information. To the extent applicable, we require these entities to comply with this Privacy Policy and appropriate confidentiality and security measures.
                            </p>
                            <p class="term-content">
                                <span style="color:#3366FF;">ADDITIONAL INFORMATION YOU SHOULD KNOW ABOUT THIRD PARTIES</span><br>
                                This Privacy Policy does not cover the information practices of third party websites linked to the Site. Although we encourage such third parties to adopt and follow their own privacy policies, we are not responsible for their collection and use of your personal information. You should refer to the privacy policies and statements of other websites or contact the respective web-masters of those websites to obtain information regarding their information collection, use and disclosure policies.
                            </p>
                            <p class="term-content">
                                When you have clicked on a third party logo or URL displayed on our Site which links you to a different website, our Privacy Policy no longer applies and you must read the privacy policy of the third party to see how your personal information will be handled on their website.
                            </p>
                        </div>

                        <div class="term-entry" id="privacy-5">
                            <p class="term-min-title">5. What choices do you have about the collection and use of your personal information?</p>
                            <p class="term-content">
                                <span style="color:#3366FF;">CONTROL OF YOUR INFORMATION</span><br>
                                You may change or delete any information you’ve shared with us by sending us an email. We do keep records of past purchases and periodically back up information, so it may not be possible for you to delete all information we have stored, and we may retain certain information to prevent fraud and for customer and order management purposes.
                            </p>
                            <p class="term-content">
                                <span style="color:#3366FF;">OPTING OUT OF RECEIVING COMMUNICATIONS FROM US</span><br>
                                If you no longer want to receive our newsletter, emails or other announcements, you may unsubscribe by using the unsubscribe link at the bottom of our emails.
                            </p>
                        </div>

                        <div class="term-entry" id="privacy-6">
                            <p class="term-min-title">6. What security measures do we take to safeguard your personal information?</p>
                            <p class="term-content">The personal information that you provide to us is stored on servers, which are located in secured facilities with restricted access, and protected by protocols and procedures designed to ensure the security of such information. In addition, we restrict access to personal information to CashBackClub employees, independent contractors and agents who need to know this information in order to develop, operate and maintain the CashBackClub Features. All CashBackClub personnel who have access to this information are trained in the maintenance and security of such information.</p>
                            <p class="term-content">However, no server, computer or communications network or system, or data transmission over the Internet can be guaranteed to be 100% secure. As a result, while we strive to protect user information, we cannot ensure or warrant the security of any information you transmit to us or through the use of any of the CashBackClub Features and you acknowledge and agree that you provide such information and engage in such transmissions at your own risk. Once we receive a transmission from you, we will endeavor to maintain its security on our systems.</p>
                            <p class="term-content">
                                <span style="color:#3366FF;">EUROPEAN COMMISSION’S DIRECTIVE ON DATA PROTECTION – SAFE HARBOR</span><br>
                                CashBackClub adheres to the Safe Harbor Principles that were established by the U.S. Department of Commerce in consultation with the European Commission to comply with the European Commission’s Directive on Data Protection.
                            </p>
                        </div>

                        <div class="term-entry" id="privacy-7">
                            <p class="term-min-title">7. About this policy</p>
                            <p class="term-content">
                                <span style="color:#3366FF;">NOTIFICATION OF CHANGES</span><br>
                                This Privacy Policy may change from time to time and we will post all changes on this page.
                            </p>
                            <p class="term-content">
                                <span style="color:#3366FF;">QUESTIONS? CONTACT US</span><br>
                                If you have any questions about our privacy practices or this Privacy Policy, please <a href="/contact" style="color: #FF9933;">contact us</a>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    <?php $this->beginBlock('js_block') ?>
    $(function () {
        $('#divstyletab li').click(function(){
            $(this).addClass('active').siblings().removeClass('active');
        });
        var urlParam = GetRequest();
        if(urlParam.tabtarget === "privacy"){
            $('#terms-tab').removeClass('active');
            $('#terms').removeClass('active');
            $('#terms-tab a').attr('aria-expanded','false');
            $('#privacy-tab').addClass('active');
            $('#privacy').addClass('active');
            $('#privacy-tab a').attr('aria-expanded','true');
        }
    });
    <?php $this->endBlock(); ?>
</script>
<?php $this->registerJs($this->blocks['js_block'],\yii\web\View::POS_END); ?>
