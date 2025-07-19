<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>SAPA Application</title>
  <style>
    @page {
      size: 8.5in 13in;
      margin: 0.5in;
    }

    body {
      background-color: white;
      margin: 0;
      padding: 0.5in;
      font-family: Arial, sans-serif;
      font-size: 12px;
    }

    .header {
      text-align: center;
      margin-bottom: 20px;
    }

    .logo-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo {
      height: 80px;
    }

    h2 {
      text-align: center;
      border-top: 1px solid #aaa;
      border-bottom: 1px solid #aaa;
      padding: 10px 0;
      margin-top: 10px;
      font-size: 1.2rem;
    }

    table {
      width: 100%;
      border-spacing: 0;
      margin-top: 15px;
    }

    td {
      padding: 5px 10px;
      vertical-align: top;
    }

    .underline {
      border-bottom: 1px solid #000;
      display: inline-block;
      width: 100%;
      min-height: 16px;
    }

    .section-title {
      background-color: #444;
      color: #fff;
      font-weight: bold;
      padding: 6px 10px;
      margin-top: 30px;
    }

    .footer {
      margin-top: 40px;
    }

    .signature {
      display: flex;
      justify-content: space-between;
      margin-top: 60px;
    }

    .signature-box {
      width: 30%;
      text-align: center;
    }

    .line {
      border-bottom: 1px solid #000;
      margin-bottom: 5px;
      height: 20px;
    }
  </style>
</head>
<body>

  <div class="logo-row">
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4c/Philippine_Civil_Seal.svg/120px-Philippine_Civil_Seal.svg.png" class="logo" alt="PH Logo">
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5a/Department_of_Environment_and_Natural_Resources.svg/120px-Department_of_Environment_and_Natural_Resources.svg.png" class="logo" alt="DENR Logo">
  </div>

  <div class="header">
    <div>Republic of the Philippines</div>
    <div>Department of Environment and Natural Resources</div>
    <div><strong>PROTECTED AREA MANAGEMENT OFFICE</strong></div>
    <div><strong>MT. APO NATURAL PARK</strong></div>
    <div> Sitio Baras, Brgy. Kapatagan, Digos City, Davao del Sur</div>
  </div>

  <h2>SPECIAL USE AGREEMENT IN PROTECTED AREAS (SAPA) APPLICATION</h2>

  <table>
    <tr>
      <td style="width: 10%;">Date Filed:</td>
      <td style="width: 20%;"><span class="underline">{{$data->application_date}}</span></td>
      <td style="width: 15%;">Type of Applicant:</td>
      <td style="width: 30%;"><span class="underline">{{$applicant_types}}</span></td>
      <td style="width: 10%;">Status:</td>
      <td><span class="underline">New</span></td>
    </tr>
  </table>

  <div class="section-title">Proponent Details</div>
  <table>
    <tr>
      <td style="width: 20%;">Name of Applicant:</td>
      <td colspan="3"><span class="underline">{{$data->user->full_name}}</span></td>
    </tr>
    <tr>
      <td>Address:</td>
      <td colspan="3"><span class="underline">{{$data->address}}</span></td>
    </tr>
    <tr>
      <td>Contact Number:</td>
      <td><span class="underline">{{$data->contact_number}}</span></td>
      <td>Email Address:</td>
      <td><span class="underline">{{$data->email_address}}</span></td>
    </tr>
  </table>

  <div class="section-title">Business/Project/Activity</div>
  <table>
    <tr>
      <td style="width: 20%;">Name:</td>
      <td colspan="3"><span class="underline">{{$data->business_name}}</span></td>
    </tr>
    <tr>
      <td>Address:</td>
      <td colspan="3"><span class="underline">{{$data->business_address}}</span></td>
    </tr>
    <tr>
      <td>Nature of Business:</td>
      <td colspan="3"><span class="underline">{{$data->business_nature->name}}</span></td>
    </tr>
    <tr>
      <td>Status:</td>
      <td colspan="3"><span class="underline">{{$data->business_status->name}}</span></td>
    </tr>
    <tr>
      <td>Capitalization:</td>
      <td colspan="3"><span class="underline">{{$data->capitalization->name}}</span></td>
    </tr>
    <tr>
      <td>Brief Description:</td>
      <td colspan="3"><span class="underline">{{$data->business_description}}</span></td>
    </tr>
  </table>

  <hr style="margin-top: 40px;">

  <p style="text-align: center;"><em>(To be filled out by the PASu)</em></p>
  <p>
    Consistent with DAO 2007-17, as amended, this SAPA application is found sufficient of the requirements to proceed with the processing and procurement of all requirements leading to the subsequent approval of the MANP PAMB and endorsement recommending for the issuance of the SAPA, received this __________ day of __________________, _________.
  </p>

  <div class="signature">
    <div class="signature-box">
      <div class="line">{{$data->user->full_name}}</div>
      <div><em>Name of Applicant/Proponent</em></div>
    </div>
    <div class="signature-box">
      <div class="line">&nbsp;</div>
      <div><em>PASu, MANP / Received by:</em></div>
    </div>
  </div>

</body>
</html>
