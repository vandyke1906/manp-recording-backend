<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Letter of Intent</title>
  <style>
    body {
      font-family: 'Times New Roman', serif;
      font-size: 16px;
      margin: 60px;
      color: #000;
    }
    .date {
      text-align: right;
      margin-bottom: 40px;
    }
    .recipient {
      margin-bottom: 40px;
      line-height: 1.5;
    }
    .subject {
      font-weight: bold;
      margin-bottom: 20px;
    }
    .body {
      text-align: justify;
      line-height: 1.6;
    }
    .closing {
      margin-top: 40px;
    }
    .signature {
      margin-top: 60px;
    }
    .signature-name {
      font-weight: bold;
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="date">
    {{$Date}}<br>
  </div>

  <div class="recipient">
    <strong>THE PROTECTED AREA MANAGEMENT BOARD</strong><br>
    Mt. Apo Natural Park<br>
    Sitio Baras, Brgy. Kapatagan,<br>
    Digos City, Davao del Sur
  </div>

  <div class="subject">
    SUBJECT: LETTER OF INTENT TO APPLY FOR SPECIAL USE AGREEMENT IN PROTECTED AREAS (SAPA)
  </div>

  <div class="body">
    Greetings!<br><br>

    I am {{$NameOfApplicant}}, a {{$TypeOfApplicant}} with business address at {{$BusinessAddress}}. I am writing to express my intent to apply for a Special Use Agreement in Protected Areas (SAPA) for the purpose of {{$PurposeOfUse}} within the Mt. Apo Natural Park (MANP).<br><br>

    The proposed project/activity is located in {{$ProjectLocation}}, and will involve {{$BriefProjectDescription}}. I affirm my commitment to comply with all rules, regulations, and requirements set forth by the Department of Environment and Natural Resources and the Mt. Apo Natural Park Protected Area Management Board.<br><br>

    In support of this application, I will be submitting all necessary documentary requirements, including this letter, accomplished SAPA application form, and other pertinent documents for your review and evaluation.<br><br>

    I am hopeful for your favorable consideration. Should there be any further requirements or clarifications, I may be contacted at {{$ContactNumber}} or via email at {{$EmailAddress}}.<br><br>

    Thank you very much.
  </div>

  <div class="closing">
    Respectfully yours,
  </div>

  <div class="signature">
    <div class="signature-name">{{$NameOfApplicant}}</div>
    <div>Proponent</div>
  </div>

</body>
</html>
