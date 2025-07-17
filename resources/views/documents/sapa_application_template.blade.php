<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>SAPA Application</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #1c1c1c;
      color: #ffffff;
      padding: 40px;
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
      border-bottom: 1px solid #fff;
      display: inline-block;
      width: 100%;
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
    .signature div {
      text-align: center;
      width: 45%;
    }
    .line {
      border-bottom: 1px solid #fff;
      margin-bottom: 5px;
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
      <td style="width: 15%;">Date Filed:</td>
      <td style="width: 35%;"><span class="underline">{{$DateFiled}}</span></td>
      <td style="width: 10%;">Status:</td>
      <td>
        <label><input type="checkbox"> New</label>
        <label><input type="checkbox"> Renewal</label>
        <label><input type="checkbox"> Under MOA?</label>
      </td>
    </tr>
  </table>

  <table>
    <tr>
      <td style="width: 20%;">Name of Applicant:</td>
      <td colspan="3"><span class="underline">{{$Applicant}}</span></td>
    </tr>
    <tr>
      <td>Address:</td>
      <td colspan="3"><span class="underline">{{$Address}}</span></td>
    </tr>
    <tr>
      <td>Contact Number:</td>
      <td><span class="underline">{{$ContactNumber}}</span></td>
      <td>Email Address:</td>
      <td><span class="underline">{{$EmailAddress}}</span></td>
    </tr>
  </table>

  <div class="section-title">Type of Applicant:</div>
  <table>
    <tr>
      <td style="width: 25%;"><input type="checkbox"> Cooperative</td>
      <td style="width: 25%;"><input type="checkbox"> Corporation</td>
      <td style="width: 25%;"><input type="checkbox"> Indigenous People</td>
      <td><span class="underline">{{$IndigenousPeople}}</span></td>
    </tr>
    <tr>
      <td><input type="checkbox"> Individual</td>
      <td><input type="checkbox"> Local Government Unit</td>
      <td colspan="2"><span class="underline">{{$LocalGovernmentUnit}}</span></td>
    </tr>
    <tr>
      <td><input type="checkbox"> National Government Agency</td>
      <td><input type="checkbox"> Peoples Organization</td>
      <td><input type="checkbox"> Tenured Migrant</td>
      <td></td>
    </tr>
    <tr>
      <td>Capitalization:</td>
      <td colspan="3"><span class="underline">{{$Capitalization}}</span></td>
    </tr>
  </table>

  <div class="section-title">Business/Project/Activity</div>
  <table>
    <tr>
      <td style="width: 20%;">Name:</td>
      <td colspan="3"><span class="underline">{{$BusinessName}}</span></td>
    </tr>
    <tr>
      <td>Address:</td>
      <td colspan="3"><span class="underline">{{$BusinessAddress}}</span></td>
    </tr>
    <tr>
      <td>Nature of Business:</td>
      <td colspan="3"><span class="underline">{{$NatureOfBusiness}}</span></td>
    </tr>
    <tr>
      <td>Status:</td>
      <td colspan="3"><span class="underline">{{$StatusOfBusiness}}</span></td>
    </tr>
    <tr>
      <td>Brief Description:</td>
      <td colspan="3"><span class="underline">{{$BriefDescription}}</span></td>
    </tr>
  </table>

  <hr style="margin-top: 40px;">

  <em>(To be filled out by the PASu)</em>
  <p>
    Consistent with DAO 2007-17, as amended, this SAPA application is found sufficient of the requirements to proceed with the processing and procurement of all requirements leading to the subsequent approval of the MANP PAMB and endorsement recommending for the issuance of the SAPA, received this __________ day of __________________, _________.
  </p>

  <div class="signature">
    <div>
      <div class="line">{{$Applicant}}</div>
      <div><em>Name of Applicant/Proponent</em></div>
    </div>
    <div>
      <div class="line">&nbsp;</div>
      <div><em>PASu, MANP / Received by:</em></div>
    </div>
  </div>

</body>
</html>
