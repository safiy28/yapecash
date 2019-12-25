@include('layout.partials.page-header')


<div class="area small-header">
    <div class="wrapper">
        <div class="logo"><a href="/"><img src="images/logo.png"  class="wow fadeInDown" alt=""/></a></div>
        <div class="btn-area">
            @if (Session()->has('is_verified'))
                <a href="{!!url('/')!!}/services">Dashboard</a>
            @else
                <a href="/">Home</a>
                <a href="{!!url('/')!!}/login">Login</a>
            @endif



        </div>
    </div>
</div>

<div class="area contentArea">
    <div class="wrapper">
        <h1 class="title-text">Terms &amp; Conditions</h1>
        <div class="tram">
            <p>Consumer Advisory –, the holder of stored value facility, does not require the approval of the Monetary Authority of Singapore. Consumers (users) are advised to read the Terms and Conditions carefully.<br>
                <br>
                YOU SHOULD NOT REGISTER FOR A MYCASH ONLINE ACCOUNT OR YOU SHOULD IMMEDIATELY CEASE YOUR USE OF MYCASH ONLINE IF AT ANY TIME YOU DISAGREE WITH ANY OF THE TERMS OF SERVICE HEREIN. YOUR REGISTRATION AND/OR CONTINUED USE OF MYCASH ONLINE SHALL MEAN THAT YOU UNDERSTAND, ACCEPT AND AGREE TO BE GOVERNED BY ALL OF MYCASH ONLINE’S TERMS AND CONDITIONS OF SERVICE. YOU MUST BE AT LEAST 18 YEARS OF AGE TO REGISTER A MYCASH ONLINE ACCOUNT. IF YOU ARE BETWEEN THE AGES OF 12-18 YEARS, YOU MAY REGISTER A MYCASH ONLINE ACCOUNT WITH YOUR PARENT OR LEGAL GUARDIAN’S CONSENT.
                <br>
                <br>
            </p>
            <h3>PREAMBLE</h3>
            <p>
                The MyCash Online services are provided by MYCASH ONLINE (SG) PTE. LTD. (UEN No: 201616811C), a private limited company incorporated in the Republic of Singapore. These Terms of Service shall govern your access to or use of MyCash Online. As long as you abide by these Terms of Service, we grant to you a revocable, non-transferable, non-exclusive and limited right to use our MyCash Online services in accordance with the terms hereof.
                <br><br>
                We reserve the right to amend, modify, add or remove any provisions under these Terms of Service at any time as we deem necessary by providing you with 30 days’ notice of such change. After such notice period, changes shall become effective upon upload and publication by us on this site. Your continued use of MyCash Online shall constitute your acceptance of the prevailing Terms of Service including any term which may have been amended from time to time. You are responsible to regularly check these Terms of Service for any update or amendment to terms. <br>
            </p>
            <br>
            <h3>1. DEFINITIONS</h3>
            <p> For the purposes of these Terms of Service, the following expressions or capitalized words when used herein shall have the following meaning: -
            <ul>“MAS” refers to The Monetary Authority of Singapore;</ul>
            <ul>“SVF” or “Stored Value Facility” refers to electronically stored funds in exchange for monies paid which may be used as a payment instrument or for other transactions with participating merchants;</ul>
            <ul>“merchants” refers to parties or entities which accept the stored value in the SVF as payment through MyCash Online website & mobile application; </ul>
            <ul>“Terms of Service” refers to these terms and conditions for the MyCash Online services and shall include the terms of our Privacy Notice and other applicable provisions linked hereto and governing the use of MyCash Online;</ul>
            <ul>“MyCash Online” refers to the telco agnostic digital wallet operated by MYCASH ONLINE (SG) PTE. LTD.  which can be used through www.mycashsg.com or can be downloaded via the ‘MyCash SG’ mobile application. MyCash Online facilitates various stored value related services including deposits/withdrawals, peer-to peer transfers and as a payment instrument. It also offers in-app purchases, loyalty card storage and such other features as we may add from time to time;</ul>
            <ul>“we” (and its cognate forms) refers to MYCASH ONLINE (SG) PTE. LTD., and where the context so admits, shall include its partner companies;</ul>
            <ul>“you” (and its cognate forms) refers to the party in whose name the MyCash Online account is registered and/or the MyCash Online wallet/SVF user. </ul>
            <br>
            </p>
            <h3>2. MYCASH ONLINE ACCOUNT & SERVICES</h3>
            <p>2.1  By registering for an account, you warrant and represent that you are 18 years of age or above. In the event that you are below the age of 18 years, you will be required to additionally present your parent or legal guardian’s identification document by way of proof of consent. Your parent or legal guardian shall be deemed to have agreed to be bound to these Terms of Service on your behalf.
                <br>
                2.2 You may only register one (1) MyCash Online account under each Singapore mobile phone number, up to a maximum of 20 MyCash Online Accounts. Each MyCash Online account has a load limit of SGD1,000. You represent and warrant that all information provided to us towards your MyCash Online account is true, accurate and complete, and you agree to provide us with up-to-date information of yourself including such identification, verification or other documentation as we, MAS or other lawful authorities may request from time to time. We have the right to reject your application for a MyCash Online account without the need to provide any reason. Value loading shall only be allowed via bank and credit card transfers or in any other manner as may be prescribed by us.
                <br>
                2.3 You are responsible for maintaining the security of your log-in details, personal identification number (PIN), password, touch ID and other information or feature in relation to your MyCash Online account. You shall not share any details with other parties and shall immediately change your PIN, password or identification feature and inform us if your account has been in any way compromised or you suspect any unauthorised access or use of your MyCash Online account.
                <br>
                2.4 You are responsible to check your transaction history regularly. Any irregularities should be reported to us immediately. We shall not be obligated to investigate any disputed transactions in the event that it is reported to us in excess of 7 days following the date of the transaction.
                <br>
                2.5 Your MyCash Online account is personal to you. No person other than you shall have any right of claim from us to the value stored in your MyCash Online account.
                <br>
                2.6 You acknowledge and agree that your MyCash Online account does not constitute a banking account or any form of term deposit. No interest, dividends or other payments shall be accumulated or payable to you on the value held in MyCash Online.
                <br>
                2.7 You may not assign, transfer or subcontract any of your rights or obligations under these Terms of Service to a third party without our prior written consent.
                <br>
                2.8 You agree not to hold us liable for any loss or damage whatsoever arising from your failure to keep information relating to your MyCash Online account secure and confidential or for any acts or omissions under your account or from your use of MyCash Online or for any loss or theft of your MyCash Online account. In the event that your MyCash Online malfunctions, you shall immediately notify us of such malfunction. Upon receipt of your report, MyCash will investigate whether your MyCash Online account has in fact malfunctioned through no fault of yours and if this is found to be the case, will replace your MyCash Online account (with the relevant value) within 30 working days from your notification of such malfunction to us.
                <br>
                2.9 You shall at all times ensure that you have sufficient funds to carry out any intended transaction. If for any reason your account stands in negative balance, you agree that this shall constitute a debt owing from you to us and repayable immediately by way of reloading or deposit. Your failure to do so promptly shall constitute a breach of these Terms of Service and we shall be entitled to proceed with such action as we deem fit including suspension or termination of your account and commencement of legal action against you.
                <br>
                2.10 You agree that we may impose a limit on the amount of stored value held in your MyCash Online account or the number of transactions you may execute in a specific period of time.
                <br>
                2.11 We reserve the right without liability to you to modify or discontinue, temporarily or permanently, the MyCash Online services or any feature or part thereof, at our absolute discretion.
                <br>
                2.12 We may suspend your MyCash Online account with or without notice and without liability to you for purposes including but not limited to system maintenance, suspicious activities, insufficient funds, at the request of MAS or other lawful authorities, compliance checks and audits or such other reason as we deem prudent or necessary. If this occurs, you accept that you will not be able to effect transactions through MyCash Online and you agree not to hold us liable in any way for any interruption. We may also terminate or close your account with us at any time in accordance with these Terms of Service.

                <br>
                <br>
            </p>
            <h3>3. USE OF MYCASH ONLINE</h3>
            <p>
                3.1  You agree to the following terms in relation to your use or operation of your MyCash Online account: -
                <br>
                (a) You agree to use MyCash Online for valid and legal purposes only. You will not use or attempt to use MyCash Online in any way or for any purpose other than as intended or offered by us;
                <br>
                (b) You agree not to use MyCash Online to engage in money-laundering, terrorism financing, drug trafficking, wagering or other fraudulent, illegal or criminal activities. You warrant and represent that all funds received or channeled through your MyCash Online account shall originate from legitimate sources or activities;
                <br>
                (c) You will not do anything which interferes or interrupts with the proper operation of MyCash Online;
                <br>
                (d) You will not use MyCash Online in any way which undermines or infringes on our rights or the rights of any third party;
                <br>
                (e) You agree to comply with all applicable laws and regulations in connection with any transaction effected through MyCash Online.
                <br>
                3.2 We reserve the right, with or without prior notice to you, to take any one or more of the following actions in the event that you are in breach, or we have reasonable cause to believe that you are in breach, of your use of MyCash Online or any provision under these Terms of Service or any applicable laws or we have reasonable grounds to do or refrain from doing any of the following:-
                <br>
                (a)We may decline to perform or allow a transaction to be performed or completed;
                <br>
                (b) We may reverse any transaction which may have been performed or completed;
                <br>
                (c) We may suspend and/or terminate your MyCash Online account;
                <br>
                (d) We may levy a fee of maximum SGD 30.00 or claim damages or other losses from you;
                <br>
                (e) We may report the transaction to relevant authorities or law enforcement agencies; and/or
                <br>
                (f) We may take such other action as we may deem necessary or commensurate with the nature or extent of the breach
                <br>
                3.3 You agree that it is your responsibility to ensure that you have sufficient funds in your MyCash Online account to effect a transaction, that the funds are transferred to the correct intended third party, as well as the legality of your transactions. You undertake not to hold us liable for losses or damages you may suffer on account of any of the foregoing.
                <br>
                3.4 You agree not to hold us liable in any manner whatsoever in the event of a dispute between you and a merchant or other third parties unless it is manifest that such dispute arose from a breach, default, error or omission on our part us under these Terms of Service or a failure of the MyCash Online systems.
            </p>
            <br>
            <br>
            <h3>4. SUSPENSION & TERMINATION</h3>
            <p>
                4.1 We may suspend the MyCash Online services from time to time in the event of any security concerns or unexpected technical, system, maintenance, modifications, fixes, bugs or other related issues. Insofar possible, we shall provide to you reasonable prior notice.
                <br>
                4.2 We may also suspend your MyCash Online account at any time in the event of any suspicious or fraudulent activity or your violation of any of the terms herein.
                <br>
                4.3 Your MyCash Online account will be suspended in the event that it is dormant or no transactions have been effected by you through MyCash Online for a period in access of 6 months. You will be required to contact us to reactivate your account and we reserve the right to charge a reactivation fee of maximum SGD 50.00.
                <br>
                4.4 You agree that we may at any time, with or without prior notice and as we deem fit or necessary, suspend or terminate your MyCash Online account or the MyCash Online services generally for causes including but not limited to the following: -
                <br>
                (a) your breach of any of these Terms of Service;
                <br>
                (b) we have reason to believe that your account is used in connection with any fraudulent, criminal or other illegal activities;
                <br>
                (c) if we cease for whatsoever reason to provide any or all of the MyCash Online services;
                <br>
                (d) if we are no longer in possession of the requisite approval or licence (where applicable) for the operating the SVF; and/or
                <br>
                (e) at the request of MAS or any governmental or law enforcement body or agency.
                <br>
                4.5 Your MyCash Online account is valid for use for a maximum of 2 years from the date that it is registered and validated for use by us, and thereafter your MyCash Online account shall expire. We may in its discretion and from time to time extend the validity period for your MyCash Online account.
                <br>
                4.6 Upon the expiry of your MyCash Online account or should you wish to terminate your MyCash Online account, you may, at any time, submit a request to us for a refund of the unclaimed balance (the “Refund Request”), unless your MyCash Online account has been suspended. Such request shall be made in the manner and form and accompanied by the information and supporting documentation as may be required by us from time to time. Upon receipt of your request, we will provide, subject to verification and deductions, if any, a full refund of the unclaimed balance to you.
                <br>
                4.7 Where your MyCash Online account is found to be defective, the process for the refund of the stored value on the defective MyCash Online account shall, mutatis mutandis, follow the same refund procedure as detailed in the context of the Refund Request (set out above). A replacement of your MyCash Online account shall be issued to you provided that you pay the minimum stored value amount. The defective MyCash Online account shall be terminated upon such request for replacement. For the purposes of this clause, a your MyCash Online account shall only be regarded as “defective” in the event its electronic data cannot be reliably read for any reason whatsoever as determined by us.
                <br>
                4.8 All pending transactions and any fees or sums due to us or other parties will be processed and deducted prior to the closure of your MyCash Online account. A maximum of SGD 20.00 may be charged as closing fees. Thereafter, any remaining positive balance will be encashed and deposited into your nominated bank account but subject always to satisfactory security verification and provided always that there are no pending disputes, claims or lawful reasons for us to hold or retain any sums
                <br>
                <br>
            </p>
            <h3>5.DISCLAIMER</h3>
            <p>
                MYCASH ONLINE SERVICES ARE PROVIDED ON AN “AS IS” AND “AS AVAILABLE” BASIS. WE MAKE NO REPRESENTATION OR WARRANTY, EXPRESS OR IMPLIED, THAT THE SERVICES OR ANY FEATURE THEREOF SHALL ALWAYS BE RELIABLE, TIMELY, SECURE OR DEFECT FREE, OR THAT THE SERVICES WILL BE UNINTERRUPTED AND AVAILABLE AT ALL OR ANY PARTICULAR TIME OR LOCATION.
                <br> YOU ACCEPT THAT WE DO NOT REPRESENT OR WARRANT THAT THE PLATFORM, SYSTEM OR SOFTWARE WILL BE UP-TO-DATE OR ERROR-FREE AT ALL TIMES. YOU ARE ALSO AWARE AND ACKNOWLEDGE THAT THE SERVICES RELY ON THIRD PARTY TECHNOLOGIES AND FACILITIES INCLUDING WIRELESS CONNECTIVITY WHICH ARE NOT WITHIN OUR CONTROL. YOU ACKNOWLEDGE THE CHARACTERISTICS AND LIMITATIONS OF DIGITAL AND WIRELESS NETWORKS AND THAT DATA MAY BE CORRUPTED, DELAYED OR LOST DESPITE SECURITY AND OTHER MEASURES TAKEN BY US. YOU AGREE NOT TO HOLD US LIABLE FOR ANY FAILURES AS HIGHLIGHTED ABOVE.
                <br> YOU EXPRESSLY AGREE THAT YOUR USE OF THE SERVICES IS AT YOUR SOLE RISK AND DISCRETION AND YOU WILL ASSUME TOTAL RESPONSIBILITY THEREFOR. YOU WILL RELY ON YOUR OWN
                <br> REVIEW AND EVALUATION OF THE SERVICES TO ASSESS ITS SUITABILITY FOR YOUR PARTICULAR PURPOSE. YOUR SOLE REMEDY AGAINST US IN THE EVENT OF DISSATISFACTION IS TO CEASE USING THE SERVICES.
                <br>
                <br>
            </p>
            <h3>6.LIABILITY</h3>
            <p>
                6.1 Our obligations hereunder relate strictly to the operation of your MyCash Online account  and its related services. We shall not be liable for the goods, services or any transactions which you conduct with merchants or other parties via your MyCash Online account. You shall resolve all and any dispute whether as to quality, safety, merchantability, legality or any other matters directly with the relevant merchant or third party.
                <br>
                6.2 You shall promptly notify us in writing with sufficient details in the event that you erroneously input the wrong transaction amount, transferee details or other requisite information. We may assist to investigate but shall not be obligated to reverse the transaction. You understand and accept that the consent of other parties may be involved for any reversals or refunds and you shall resolve the matter directly with the said party if necessary.
                <br>
                6.3 You shall be solely responsible for any fees charged by merchants, banks or other third parties and/or the payment of goods and services tax (GST) and any other duties or charges arising from the transaction undertaken by you with merchants and third parties.
                <br>
                6.4 We shall not be responsible in the event that your MyCash Online account is compromised due to your failure to keep your log-in details, password and/or PIN secure. You should promptly notify us in any such event in order that we may reasonably assist to stop or arrest any unauthorised use, including suspending your MyCash Online account.
                <br>
                6.5 You shall report to us any dispute relating to your transaction history within 7 days following the date of the disputed transaction, failing which all transactions shall be deemed correct and final and no further queries will be entertained. We will investigate any dispute raised by you within the stipulated period but shall be under no obligation to effect any reversal or refund unless our investigations reveal an error in our system or default on our part, or the consent of the affected third party, if necessary, has been duly given.
                <br>
                6.6 To the fullest extent permitted by law, we, including our directors, officers, employees and affiliated companies, will not liable to you or any third party for any loss or damages whatsoever, whether direct, indirect, consequential, punitive, exemplary or incidental arising out of or in connection with your MyCash Online account or the failure of MyCash Online to operate, including without limitation loss of opportunity or goodwill or revenue, damage to property, injury to person or death, theft or fraud. Your acceptance of this limitation is an essential term of your use of MyCash Online and our services and you acknowledge that we would not have otherwise agreed to provide the MyCash Online services to you without your agreement to this term.

                <br>
                <br>
            </p>
            <h3>7.INDEMNITY</h3>
            <p>You agree to indemnify us, our directors, officers and employees and our affiliated companies to the fullest extent possible, from and against any and all liabilities, costs, demands or claims whatsoever on a full indemnity basis, which may be made by any third party due to a breach by you of any of these Terms of Service, or arising in any way from or in connection with your default, omissions, negligence or use of the MyCash Online Services.
                <br>
                <br>
            </p>
            <h3>8.INTELLECTUAL PROPERTY RIGHTS </h3>
            <p>
                8.1 You shall use MyCash Online strictly in accordance with these Terms of Service and shall not:  (a) decompile, reverse engineer, disassemble, attempt to derive the source code or decrypt the MyCash Online application;  (b) make any modification, adaptation, improvement, translation or derivative work from the application;  (c) violate any applicable laws, rules or regulations in connection with your access or use of the MyCash Online application;  (d) remove, alter or obscure any proprietary notice in connection with the application;  (e) use the application for any revenue-generating endeavor, commercial enterprise or other purposes for which it was not designed or intended;  (f) use the application for creating a service, product or software which directly or indirectly competes or substitutes the MyCash Online services;  (g) use the application to send out unsolicited emails; or  (h) use any of our intellectual property or other proprietary information in the design, development of distribution of any applications, accessories or devices for use with MyCash Online.
                <br>
                8.2 You should assume that all software and collaterals in connection with MyCash Online, and all graphics, text, photographs, artwork, logos, user interfaces, sounds, music, computer code and other materials in this website or our MyCash Online application, including but not limited to our logos, the design, “look and feel”, expression and arrangement of the website and application, is owned, controlled by or licensed to us and/or protected by copyright, trademark or other intellectual property rights. Save as expressly provided herein, no license is granted to you by implication, estoppel or otherwise with respect our intellectual property and you may not use, copy, reproduce, transmit or distribute any component or part of our intellectual property without our prior written consent.

                <br>
                <br>
            </p>
            <h3>9.PRIVACY NOTICE & DATA PROTECTION OBLIGATIONS</h3>
            <p>9.1 Our Privacy Notice is incorporated into these Terms of Service by reference. You agree to our Privacy Notice and accept that it forms an essential and integral part of these Terms of Service. You consent to our use of your personal data in accordance with the terms of our Privacy Notice and our prevailing privacy policies.
                <br>
                9.2 You agree that by registering an account with us and/or using MyCash Online, you have authorised and consented to your personal data being disclosed to and/or processed by third parties for the purposes of providing the MyCash Online Services to you.
                <br>
                9.3 You grant us consent to confirm your personal data with other entities or agencies in order to verify your identity and/or to comply with any legal or regulatory requirements in connection with MyCash Online services.
                <br>
                9.4 You accept that we may be required to revise our Privacy Notice and/or policy from time to time. All revisions will be promptly notified through our website. Your continued use of MyCash Online services shall mean that you have agreed and consented to our Privacy Notice and policy as revised.
                <br>
                9.5 In the event that the personal data of minor children under your care is provided to us, you expressly consent to the processing of the child’s personal data for the purposes of the services and as disclosed herein and personally accept and agree to be bound by our Privacy Notice and to take responsibility on his/her behalf.
                <br>
                <br>
            </p>
            <h3>10.GENERAL PROVISIONS</h3>
            <p>
                10.1 If any provision of these Terms of Service is found to be invalid, void or unenforceable under any applicable law, such provision shall be excluded or deemed deleted to the limited extent necessary and replaced with a valid provision that best embodies the intent of these Terms of Service. The remaining provisions herein shall not be affected and shall continue to apply to the fullest extent.
                <br>
                10.2 Our failure to enforce or insist on strict performance of any of these Terms of Service shall not be construed as a waiver of any provision or right herein unless such waiver is made in writing, nor shall any course of conduct between us or any other party be deemed to modify any provision of these Terms of Service.
                <br>
                10.3 These Terms of Service may not be construed or interpreted to confer any rights or remedies on any third parties.
                <br>
                10.4 Where any term hereof by its sense, nature or context is intended to survive the closure of your MyCash Online account or termination of the agreement between us, such term shall continue in full force and effect to be binding on you, including without limitation terms as to representations, warranties and indemnities given by you, our intellectual property rights, personal data protection and limitation of liability.
                <br>
                10.5 We will not be responsible for any delay or failure in the performing our obligations herein due to an unforeseeable event or cause which is not within our reasonable control (force majeure). Force majeure events shall include without limitation acts of sabotage, fire, natural catastrophes, regulatory changes or directives, and failure or interruption of utilities such as electricity, communications or internet service providers or banking systems.
                <br>
                10.6 We may assign, transfer, subcontract and/or novate our rights or obligations under these Terms of Service as we deem fit or necessary subject only to prior notice to you.
                <br>
                10.7 In the event of a dispute between the English and non-English versions of these Terms of Service (if any), the English version shall be the prevailing and governing version.
                <br>
                10.8 These Terms of Service shall be governed and construed in accordance with the laws of Singapore and in the event of any legal proceedings arising out of or in connection herewith, you agree to submit to the exclusive jurisdiction of the courts of Singapore. Any dispute arising out of or in connection with these Terms and Conditions, including any question regarding its existence, validity or termination, shall be referred to and finally resolved by arbitration administered by the Singapore International Arbitration Centre (“SIAC”) in accordance with the Arbitration Rules of the Singapore International Arbitration Centre ("SIAC Rules") for the time being in force, which rules are deemed to be incorporated by reference in this clause. The seat of the arbitration shall be Singapore. The Tribunal shall consist of 3 arbitrators - one chosen by us, one by you, and one mutually chosen by both parties. The language of the arbitration shall be in English.
                <br>
                <br>
                Last Updated: 26 March 2018
                <br>
            </p>

        </div>
    </div>

</div>

@include('layout.partials.footer')