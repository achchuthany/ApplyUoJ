@component('mail::message')
Dear {{$name}},

We are pleased to welcome you to the University of Jaffna to pursue your degree program for the Academic Year <b>{{$academic_year}}</b>.
You have been selected by the University Grants Commission (UGC) to follow the <b>{{$programme}}</b> course of study at the <b>{{$faculty}}</b>.

Complete the online enrollment **before the {{$close_date}}**.

## Steps to Complete Your Enrollment:
1. **Prepare Required Documents**
To process your application, you must upload the following documents via the SIS Portal. Ensure all documents are scanned in either <b>‘jpeg’ or ‘jpg’</b> formats, with each file size being less than <b>3MB</b>.
    - Your recent photograph. (Color and plain light background)
    - Selection Letter sent by the UGC
    - Paid Bank Slip - <a target="_blank" href="https://sis.jfn.ac.lk/info"> Payment Details </a>
    - School Leaving Certificate Front Side
    - School Leaving Certificate Back Side
    - National Identity Card Front Side
    - National Identity Card Back Side
    - Signature of the Student (Sign on a clean white paper using a blue pen)

2. **Pay the Enrollment Fee**
Payment of the enrollment fee is mandatory. You can make the payment at any branch of the <b>People’s Bank</b> in favor of the University of Jaffna Collection Account. The payment details are as follows:
    - **Amount:** LKR {{$amount}}
    - **Account Number:** {{$account_number}}
    - **Bank:** People’s Bank
* Refer to the <a target="_blank" href="https://sis.jfn.ac.lk/info">Payment Details</a> for more payment related information.

3. **Create an Account**
Visit the <a target="_blank" href="https://sis.jfn.ac.lk/register">SIS Portal</a> and create your account. Follow the portal's instructions to complete your enrollment.

4. **Submit the Hard Copy of Documents**
After completing the online enrollment process, print the submitted online application form and send it along with the required documents(listed on the SIS Portal) to:
    - **Senior Assistant Registrar, Admissions Branch, University of Jaffna.**

5. **Enrollment Confirmation**
After successful completion of your online enrollment, you will receive an email confirming that your enrollment has been "Accepted" and your Enrollment Number will be assigned.

6. **Next Steps**
After the receiving your Enrollment Number, contact the relevant faculty to learn about the commencement date or ongoing arrangements for the Academic Year.

@component('mail::button', ['url' => 'https://sis.jfn.ac.lk/apply', 'color' => 'primary'])
    Start the Enrolment Now
@endcomponent

Thanks,<br/>
Admissions Branch, University of Jaffna<br/>
<i>This is system generated email.</i>
@endcomponent
