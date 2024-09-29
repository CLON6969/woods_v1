<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


        <!--bootstrap css links-->
        <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
        <link rel="stylesheet" href="css/inuse.min.css">
           
           
                <!--bootstrap js links-->
                <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
           
     <!--=====CSS link=====-->
     <link rel="stylesheet" href="Resources/staff_registration.css?v=<?php echo time(); ?>">

        <!--=====fontawsome links====-->
        <link rel="stylesheet" href="Resources/fontawesome/css/solid.css">
        <link rel="stylesheet" href="Resources/fontawesome/webfonts/fa-solid-900.woff2">
        <link rel="stylesheet" href="Resources/fontawesome/css/all.css">
        <link rel="stylesheet" href="Resources/fontawesome/css/brands.css">
        <link rel="stylesheet" href="Resources/fontawesome/css/fontawesome.css">
        <link href="Resourses/fontawesome/css/solid.css" rel="stylesheet" />

          <!--=====JAVA SCRIPT LINKS====-->
   
    
  
        <title>aplication  form</title>
</head>
<body>
    <div class="first_container position-relative">
        <header>WOODS staff enrollment form
          
        </header>
        <form method="post" action="staff_connection.php" class=" needs-validation"  >
            <div class="form first position-relative">
                <div class="details personal position-relative">
                    <span class="sub_tittle">Personal details</span>

                    <div class="fields position-relative">


                        <div class="input_field position-relative">
                            <label for="firstname validationTooltip" class="form-label">First name</label>
                            <input type="text" class="form-control" id="validationTooltip firstname" name="firstname" placeholder="First name" required>
                            <div class="valid-tooltip">
                              Looks good!
                            </div>
                            <div class="invalid-feedback">
                              invalid in put
                            </div>
                          </div>


                          <div class="input_field position-relative">
                            <label for="middlename validationTooltip" class="form-label">Middle name</label>
                            <input type="text" class="form-control" id="validationTooltip middlename" name="middlename"  placeholder="Middle name" >
                            <div class="valid-tooltip">
                              Looks good!
                            </div>
                          </div>



                          <div class="input_field position-relative">
                            <label for="lastname  validationTooltip" class="form-label">Last name</label>
                            <input type="text" class="form-control" id="validationTooltip lastname" name="lastname"placeholder="Last name" required>
                            <div class="valid-tooltip">
                              Looks good!
                            </div>
                          </div>


                          <div class="input_field position-relative">
                            <label for="gender validationTooltip" class="form-label">Gender</label>
                           
<select id="validationTooltip  gender" name="gender" class="form-select"  required>
                              

    <option value="">Select</option>
    <option value="M">Male</option>
    <option value="F">Female</option>
<!--
    <option value="Non-Binary">Non-Binary</option>
    <option value="Transgender">Transgender</option>
    <option value="Genderfluid">Genderfluid</option>
    <option value="Agender">Agender</option>
    <option value="Bigender">Bigender</option>
    <option value="Gender Nonconforming">Gender Nonconforming</option>
    <option value="Gender Questioning">Gender Questioning</option>
    <option value="Gender Variant">Gender Variant</option>
    <option value="Intersex">Intersex</option>
    <option value="Two-Spirit">Two-Spirit</option>
    <option value="Prefer Not to Say">Prefer Not to Say</option>
-->
    <option value="O">Other</option>

</select>
                            <div class="invalid-tooltip">
                              Please select a valid gender.
                            </div>
                          </div>

                        
                          <div class="input_field position-relative">
                            <label for="phonenumbervalidationTooltip" class="form-label">Mobile number</label>
                            <input type="text" class="form-control" id="validationTooltip phonenumber" name="phonenumber" placeholder="(00)(00-00)(00-00)" required>
                            <div class="valid-tooltip">
                              Looks good!
                            </div>
                          </div>



                          <div class="input_field position-relative">
                            <label for="validationTooltipUsername email" class="form-label">Email</label>
                            <div class="input-group has-validation">
                              <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
                              <input type="text" class="form-control" id="validationTooltipUsername email" name="email" aria-describedby="validationTooltipUsernamePrepend"  placeholder="Exaple@gmail.com " required>
                              <div class="invalid-tooltip">
                                Please choose a unique and valid email.
                              </div>
                            </div>
                          </div>


                    </div>
                    

                </div>



                <div class="details_id position-relative">
  
                    <span class="tittle"></span>

                    <div class="fields position-relative">





                          <div class="input_field position-relative">
                            <label for="validationTooltip religion" class="form-label">Religion</label>
                          
 <select id="validationTooltip religion" name="religion" class="form-select"  required> 


    <option value="">Select</option>
    <option value="Christianity">Christianity</option>
    <option value="Islam">Islam</option>
    <option value="Hinduism">Hinduism</option>
    <option value="Buddhism">Buddhism</option>
    <option value="Judaism">Judaism</option>
    <option value="Sikhism">Sikhism</option>
    <option value="Taoism">Taoism</option>
    <option value="Confucianism">Confucianism</option>
    <option value="Shinto">Shinto</option>
    <option value="Zoroastrianism">Zoroastrianism</option>
    <option value="Baha'i Faith">Baha'i Faith</option>
    <option value="Jainism">Jainism</option>
    <option value="Daoism">Daoism</option>
    <option value="Shintoism">Shintoism</option>
    <option value="Animism">Animism</option>
    <option value="Atheism">Atheism</option>
    <option value="Agnosticism">Agnosticism</option>
    <option value="Indigenous Beliefs">Indigenous Beliefs</option>
    <option value="Other">Other</option>
</select>
                            <div class="invalid-tooltip">
                              Please select a valid religeion.
                            </div>
                          </div>


                          <div class="input_field position-relative">
                            <label for="validationTooltip marital_status" class="form-label">Marital status</label>
                          
<select  id="validationTooltip marital_status" name="marital_status" class="form-select" required>
                              
    <option value="">Select</option>
    <option value="Single">Single</option>
    <option value="Married">Married</option>
    <option value="Divorced">Divorced</option>
    <option value="Widowed">Widowed</option>
    <option value="Separated">Separated</option>
    <option value="Domestic Partnership">Domestic Partnership</option>
    <option value="Civil Union">Civil Union</option>
    <option value="Engaged">Engaged</option>
    <option value="Cohabiting">Cohabiting</option>
    <option value="Annulled">Annulled</option>
    <option value="Polygamous">Polygamous</option>
    <option value="Other">Other</option>


</select>
                            <div class="invalid-tooltip">
                              Please select a valid marital status.
                            </div>
                          </div>



                          <div class="input_field position-relative">
                            <label for="validationTooltip date_of_birth" class="form-label">Date of birth</label>
                            <input type="date" class="form-control" id="validationTooltip date_of_birth" name="date_of_birth" placeholder="Date of birth"required>
                            <div class="valid-tooltip">
                              Looks good!
                            </div>
                          </div>


                          <div class="input_field position-relative">
                            <label for="validationTooltip national_id_number" class="form-label">Nationalid number</label>
                            <input type="number" class="form-control" id="validationTooltip national_id_number" name="national_id_number" placeholder="(00)(00-00)(00-00)" required>
                            <div class="valid-tooltip">
                              Looks good!
                            </div>
                          </div>


                          <div class="input_field position-relative">
                            <label for="validationTooltip emergency_phone" class="form-label">Emergency phone</label>
                            <input type="text" class="form-control"  id="validationTooltip emergency_phone" name="emergency_phone" placeholder="(00)(00-00)(00-00)" required>
                            <div class="valid-tooltip">
                              Looks good!
                            </div>
                          </div>


                        <div class="input_field">
                            <label for="profile_file">Profile picture </label>
                            <div class="file_icon">
                                <i class="fa-solid fa-upload"></i>
                            <input class="form-control files" type="file"  id="profile_file" name="profile_file"  aria-label="file example" required> 
                        </div>
                        <div class="invalid-feedback">Example invalid form file feedback</div>
                        </div>



                        <div class="input_field position-relative">
                            <label for="validationTooltip      job_tittle" class="form-label">job_title</label>
                          

                              
<select id="validationTooltip job_tittle" name="job_tittle" class="form-select" required>


    <option value="">Select</option>
    <option value="university_president">University President</option>
    <option value="chancellor">Chancellor</option>
    <option value="provost">Provost</option>
    <option value="vice_president_academic_affairs">Vice President of Academic Affairs</option>
    <option value="vice_president_administration">Vice President of Administration</option>
    <option value="vice_president_student_affairs">Vice President of Student Affairs</option>
    <option value="dean">Dean</option>
    <option value="associate_dean">Associate Dean</option>
    <option value="assistant_dean">Assistant Dean</option>
    <option value="director_admissions">Director of Admissions</option>
    <option value="registrar">Registrar</option>
    <option value="director_financial_aid">Director of Financial Aid</option>
    <option value="director_student_services">Director of Student Services</option>
    <option value="director_career_services">Director of Career Services</option>
    <option value="director_human_resources">Director of Human Resources</option>
    <option value="director_campus_security">Director of Campus Security</option>
    <option value="director_facilities_management">Director of Facilities Management</option>
    <option value="director_information_technology">Director of Information Technology</option>
    <option value="director_alumni_relations">Director of Alumni Relations</option>
    <option value="director_marketing_communications">Director of Marketing and Communications</option>
    <option value="professor">Professor</option>
    <option value="associate_professor">Associate Professor</option>
    <option value="assistant_professor">Assistant Professor</option>
    <option value="adjunct_professor">Adjunct Professor</option>
    <option value="lecturer">Lecturer</option>
    <option value="senior_lecturer">Senior Lecturer</option>
    <option value="instructor">Instructor</option>
    <option value="teaching_assistant">Teaching Assistant</option>
    <option value="research_assistant">Research Assistant</option>
    <option value="postdoctoral_researcher">Postdoctoral Researcher</option>
    <option value="department_chair">Department Chair</option>
    <option value="program_coordinator">Program Coordinator</option>
    <option value="academic_advisor">Academic Advisor</option>
    <option value="career_counselor">Career Counselor</option>
    <option value="financial_aid_counselor">Financial Aid Counselor</option>
    <option value="student_affairs_coordinator">Student Affairs Coordinator</option>
    <option value="student_activities_coordinator">Student Activities Coordinator</option>
    <option value="residential_life_coordinator">Residential Life Coordinator</option>
    <option value="international_student_advisor">International Student Advisor</option>
    <option value="disability_services_coordinator">Disability Services Coordinator</option>
    <option value="mental_health_counselor">Mental Health Counselor</option>
    <option value="librarian">Librarian</option>
    <option value="assistant_librarian">Assistant Librarian</option>
    <option value="library_technician">Library Technician</option>
    <option value="archivist">Archivist</option>
    <option value="cataloger">Cataloger</option>
    <option value="research_scientist">Research Scientist</option>
    <option value="research_coordinator">Research Coordinator</option>
    <option value="lab_technician">Lab Technician</option>
    <option value="principal_investigator">Principal Investigator</option>
    <option value="research_grant_specialist">Research Grant Specialist</option>
    <option value="administrative_assistant">Administrative Assistant</option>
    <option value="executive_assistant">Executive Assistant</option>
    <option value="office_manager">Office Manager</option>
    <option value="receptionist">Receptionist</option>
    <option value="data_entry_clerk">Data Entry Clerk</option>
    <option value="it_manager">IT Manager</option>
    <option value="network_administrator">Network Administrator</option>
    <option value="system_administrator">System Administrator</option>
    <option value="database_administrator">Database Administrator</option>
    <option value="help_desk_technician">Help Desk Technician</option>
    <option value="web_developer">Web Developer</option>
    <option value="software_developer">Software Developer</option>
    <option value="facilities_manager">Facilities Manager</option>
    <option value="maintenance_technician">Maintenance Technician</option>
    <option value="custodian">Custodian</option>
    <option value="groundskeeper">Groundskeeper</option>
    <option value="security_officer">Security Officer</option>
    <option value="marketing_manager">Marketing Manager</option>
    <option value="communications_specialist">Communications Specialist</option>
    <option value="social_media_coordinator">Social Media Coordinator</option>
    <option value="graphic_designer">Graphic Designer</option>
    <option value="public_relations_specialist">Public Relations Specialist</option>
    <option value="chief_financial_officer">Chief Financial Officer (CFO)</option>
    <option value="accountant">Accountant</option>
    <option value="financial_analyst">Financial Analyst</option>
    <option value="payroll_specialist">Payroll Specialist</option>
    <option value="bursar">Bursar</option>
    <option value="development_officer">Development Officer</option>
    <option value="fundraising_coordinator">Fundraising Coordinator</option>
    <option value="grant_writer">Grant Writer</option>
    <option value="alumni_relations_coordinator">Alumni Relations Coordinator</option>
    <option value="campus_nurse">Campus Nurse</option>
    <option value="health_services_administrator">Health Services Administrator</option>
    <option value="wellness_coordinator">Wellness Coordinator</option>
    <option value="athletic_director">Athletic Director</option>
    <option value="coach">Coach</option>
    <option value="assistant_coach">Assistant Coach</option>
    <option value="athletic_trainer">Athletic Trainer</option>
    <option value="sports_information_director">Sports Information Director</option>
</select>


                            <div class="invalid-tooltip">
                              Please select a valid programe.
                            </div>
                          </div>


                          
                        <div class="input_field position-relative">
                            <label for="validationTooltip      department" class="form-label">Department</label>
                          

                              
<select id="validationTooltip department" name="department" class="form-select" required>
    
    <option value="">Select</option>
    <option value="1">Computer Science and Information Technology</option>
    <option value="2">Business and Economics</option>
    <option value="3">Engineering</option>
    <option value="4">Natural Sciences</option>
    <option value="5">Health Sciences</option>
    <option value="6">Social Sciences and Humanities</option>
    <option value="7">Arts and Design</option>
    <option value="8">Agriculture and Forestry</option>
    <option value="9">Architecture and Urban Planning</option>
    <option value="10">Hospitality and Tourism</option>
</select>



                            <div class="invalid-tooltip">
                              Please select a valid programe.
                            </div>
                          </div>
    
                    </div>
            </div>






        <!--===== NEXT PART OF THE FORM====-->








        <span class="main_tittle">Education  and address details</span>

        
                <div class="details_id">
                    <span class="sub_tittle"> adress details</span>

                    <div class="fields">

                    <div class="input_field position-relative">
                            <label for="adress1 validationTooltip" class="form-label">Addres1</label>
                            <input type="text" class="form-control" id="validationTooltip address1" name="address1" placeholder="address1" required>
                            <div class="valid-tooltip">
                              Looks good!
                            </div>
                          </div>

                          <div class="input_field position-relative">
                            <label for="address2 validationTooltip" class="form-label">Addres2</label>
                            <input type="text" class="form-control" id="validationTooltip address2" name="address2" placeholder="address2" required>
                            <div class="valid-tooltip">
                              Looks good!
                            </div>
                          </div>

                          <div class="input_field position-relative">
                            <label for="validationTooltip city" class="form-label">city</label>
                            <input type="text" class="form-control" id="validationTooltip city" name="city" placeholder="city" required>
                            <div class="valid-tooltip">
                              Looks good!
                            </div>
                          </div>


                          <div class="input_field position-relative">
                            <label for="validationTooltip state" class="form-label">state</label>
                            <input type="text" class="form-control" id="validationTooltip state" name="state" placeholder="state" required>
                            <div class="valid-tooltip">
                              Looks good!
                            </div>
                          </div>

                          

                          <div class="input_field position-relative">
                            <label for="validationTooltip nationality" class="form-label">Nationality</label>
                           
<select id="validationTooltip nationality" name="nationality"  class="form-select"  required> 
  
    <option value="">Select</option>
    <option value="Afghanistan">Afghanistan</option>
    <option value="Albania">Albania</option>
    <option value="Algeria">Algeria</option>
    <option value="Andorra">Andorra</option>
    <option value="Angola">Angola</option>
    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
    <option value="Argentina">Argentina</option>
    <option value="Armenia">Armenia</option>
    <option value="Australia">Australia</option>
    <option value="Austria">Austria</option>
    <option value="Azerbaijan">Azerbaijan</option>
    <option value="Bahamas">Bahamas</option>
    <option value="Bahrain">Bahrain</option>
    <option value="Bangladesh">Bangladesh</option>
    <option value="Barbados">Barbados</option>
    <option value="Belarus">Belarus</option>
    <option value="Belgium">Belgium</option>
    <option value="Belize">Belize</option>
    <option value="Benin">Benin</option>
    <option value="Bermuda">Bermuda</option>
    <option value="Bhutan">Bhutan</option>
    <option value="Bolivia">Bolivia</option>
    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
    <option value="Botswana">Botswana</option>
    <option value="Brazil">Brazil</option>
    <option value="Brunei">Brunei</option>
    <option value="Bulgaria">Bulgaria</option>
    <option value="Burkina Faso">Burkina Faso</option>
    <option value="Burundi">Burundi</option>
    <option value="Cabo Verde">Cabo Verde</option>
    <option value="Cambodia">Cambodia</option>
    <option value="Cameroon">Cameroon</option>
    <option value="Canada">Canada</option>
    <option value="Cayman Islands">Cayman Islands</option>
    <option value="Central African Republic">Central African Republic</option>
    <option value="Chad">Chad</option>
    <option value="Chile">Chile</option>
    <option value="China">China</option>
    <option value="Colombia">Colombia</option>
    <option value="Comoros">Comoros</option>
    <option value="Congo">Congo</option>
    <option value="Costa Rica">Costa Rica</option>
    <option value="Croatia">Croatia</option>
    <option value="Cuba">Cuba</option>
    <option value="Cyprus">Cyprus</option>
    <option value="Czechia">Czechia</option>
    <option value="Denmark">Denmark</option>
    <option value="Djibouti">Djibouti</option>
    <option value="Dominica">Dominica</option>
    <option value="Dominican Republic">Dominican Republic</option>
    <option value="Ecuador">Ecuador</option>
    <option value="Egypt">Egypt</option>
    <option value="El Salvador">El Salvador</option>
    <option value="Equatorial Guinea">Equatorial Guinea</option>
    <option value="Eritrea">Eritrea</option>
    <option value="Estonia">Estonia</option>
    <option value="Eswatini">Eswatini</option>
    <option value="Ethiopia">Ethiopia</option>
    <option value="Falkland Islands">Falkland Islands</option>
    <option value="Faroe Islands">Faroe Islands</option>
    <option value="Fiji">Fiji</option>
    <option value="Finland">Finland</option>
    <option value="France">France</option>
    <option value="French Guiana">French Guiana</option>
    <option value="French Polynesia">French Polynesia</option>
    <option value="Gabon">Gabon</option>
    <option value="Gambia">Gambia</option>
    <option value="Georgia">Georgia</option>
    <option value="Germany">Germany</option>
    <option value="Ghana">Ghana</option>
    <option value="Gibraltar">Gibraltar</option>
    <option value="Greece">Greece</option>
    <option value="Greenland">Greenland</option>
    <option value="Grenada">Grenada</option>
    <option value="Guadeloupe">Guadeloupe</option>
    <option value="Guam">Guam</option>
    <option value="Guatemala">Guatemala</option>
    <option value="Guernsey">Guernsey</option>
    <option value="Guinea">Guinea</option>
    <option value="Guinea-Bissau">Guinea-Bissau</option>
    <option value="Guyana">Guyana</option>
    <option value="Haiti">Haiti</option>
    <option value="Honduras">Honduras</option>
    <option value="Hong Kong">Hong Kong</option>
    <option value="Hungary">Hungary</option>
    <option value="Iceland">Iceland</option>
    <option value="India">India</option>
    <option value="Indonesia">Indonesia</option>
    <option value="Iran">Iran</option>
    <option value="Iraq">Iraq</option>
    <option value="Ireland">Ireland</option>
    <option value="Isle of Man">Isle of Man</option>
    <option value="Israel">Israel</option>
    <option value="Italy">Italy</option>
    <option value="Jamaica">Jamaica</option>
    <option value="Japan">Japan</option>
    <option value="Jordan">Jordan</option>
    <option value="Kazakhstan">Kazakhstan</option>
    <option value="Kenya">Kenya</option>
    <option value="Kiribati">Kiribati</option>
    <option value="Korea, North">Korea, North</option>
    <option value="Korea, South">Korea, South</option>
    <option value="Kosovo">Kosovo</option>
    <option value="Kuwait">Kuwait</option>
    <option value="Kyrgyzstan">Kyrgyzstan</option>
    <option value="Laos">Laos</option>
    <option value="Latvia">Latvia</option>
    <option value="Lebanon">Lebanon</option>
    <option value="Lesotho">Lesotho</option>
    <option value="Liberia">Liberia</option>
    <option value="Libya">Libya</option>
    <option value="Liechtenstein">Liechtenstein</option>
    <option value="Lithuania">Lithuania</option>
    <option value="Luxembourg">Luxembourg</option>
    <option value="Macao">Macao</option>
    <option value="Madagascar">Madagascar</option>
    <option value="Malawi">Malawi</option>
    <option value="Malaysia">Malaysia</option>
    <option value="Maldives">Maldives</option>
    <option value="Mali">Mali</option>
    <option value="Malta">Malta</option>
    <option value="Marshall Islands">Marshall Islands</option>
    <option value="Martinique">Martinique</option>
    <option value="Mauritania">Mauritania</option>
    <option value="Mauritius">Mauritius</option>
    <option value="Mayotte">Mayotte</option>
    <option value="Mexico">Mexico</option>
    <option value="Micronesia">Micronesia</option>
    <option value="Moldova">Moldova</option>
    <option value="Monaco">Monaco</option>
    <option value="Mongolia">Mongolia</option>
    <option value="Montenegro">Montenegro</option>
    <option value="Montserrat">Montserrat</option>
    <option value="Morocco">Morocco</option>
    <option value="Mozambique">Mozambique</option>
    <option value="Myanmar">Myanmar</option>
    <option value="Namibia">Namibia</option>
    <option value="Nauru">Nauru</option>
    <option value="Nepal">Nepal</option>
    <option value="Netherlands">Netherlands</option>
    <option value="New Caledonia">New Caledonia</option>
    <option value="New Zealand">New Zealand</option>
    <option value="Nicaragua">Nicaragua</option>
    <option value="Niger">Niger</option>
    <option value="Nigeria">Nigeria</option>
    <option value="North Macedonia">North Macedonia</option>
    <option value="Northern Mariana Islands">Northern Mariana Islands</option>
    <option value="Norway">Norway</option>
    <option value="Oman">Oman</option>
    <option value="Pakistan">Pakistan</option>
    <option value="Palau">Palau</option>
    <option value="Palestine">Palestine</option>
    <option value="Panama">Panama</option>
    <option value="Papua New Guinea">Papua New Guinea</option>
    <option value="Paraguay">Paraguay</option>
    <option value="Peru">Peru</option>
    <option value="Philippines">Philippines</option>
    <option value="Poland">Poland</option>
    <option value="Portugal">Portugal</option>
    <option value="Puerto Rico">Puerto Rico</option>
    <option value="Qatar">Qatar</option>
    <option value="Réunion">Réunion</option>
    <option value="Romania">Romania</option>
    <option value="Russia">Russia</option>
    <option value="Rwanda">Rwanda</option>
    <option value="Saint Barthélemy">Saint Barthélemy</option>
    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
    <option value="Saint Lucia">Saint Lucia</option>
    <option value="Saint Martin">Saint Martin</option>
    <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
    <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
    <option value="Samoa">Samoa</option>
    <option value="San Marino">San Marino</option>
    <option value="São Tomé and Príncipe">São Tomé and Príncipe</option>
    <option value="Saudi Arabia">Saudi Arabia</option>
    <option value="Senegal">Senegal</option>
    <option value="Serbia">Serbia</option>
    <option value="Seychelles">Seychelles</option>
    <option value="Sierra Leone">Sierra Leone</option>
    <option value="Singapore">Singapore</option>
    <option value="Sint Maarten">Sint Maarten</option>
    <option value="Slovakia">Slovakia</option>
    <option value="Slovenia">Slovenia</option>
    <option value="Solomon Islands">Solomon Islands</option>
    <option value="Somalia">Somalia</option>
    <option value="South Africa">South Africa</option>
    <option value="South Sudan">South Sudan</option>
    <option value="Spain">Spain</option>
    <option value="Sri Lanka">Sri Lanka</option>
    <option value="Sudan">Sudan</option>
    <option value="Suriname">Suriname</option>
    <option value="Sweden">Sweden</option>
    <option value="Switzerland">Switzerland</option>
    <option value="Syria">Syria</option>
    <option value="Taiwan">Taiwan</option>
    <option value="Tajikistan">Tajikistan</option>
    <option value="Tanzania">Tanzania</option>
    <option value="Thailand">Thailand</option>
    <option value="Timor-Leste">Timor-Leste</option>
    <option value="Togo">Togo</option>
    <option value="Tokelau">Tokelau</option>
    <option value="Tonga">Tonga</option>
    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
    <option value="Tunisia">Tunisia</option>
    <option value="Turkey">Turkey</option>
    <option value="Turkmenistan">Turkmenistan</option>
    <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
    <option value="Tuvalu">Tuvalu</option>
    <option value="Uganda">Uganda</option>
    <option value="Ukraine">Ukraine</option>
    <option value="United Arab Emirates">United Arab Emirates</option>
    <option value="United Kingdom">United Kingdom</option>
    <option value="United States">United States</option>
    <option value="Uruguay">Uruguay</option>
    <option value="Uzbekistan">Uzbekistan</option>
    <option value="Vanuatu">Vanuatu</option>
    <option value="Venezuela">Venezuela</option>
    <option value="Vietnam">Vietnam</option>
    <option value="Virgin Islands, British">Virgin Islands, British</option>
    <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
    <option value="Wallis and Futuna">Wallis and Futuna</option>
    <option value="Western Sahara">Western Sahara</option>
    <option value="Yemen">Yemen</option>
    <option value="Zambia">Zambia</option>
    <option value="Zimbabwe">Zimbabwe</option>
</select>


                            <div class="invalid-tooltip">
                              Please select a valid nationality.
                            </div>
                          </div>

                          <div class="input_field position-relative">
                            <label for="validationTooltip zipcode" class="form-label">zipcode</label>
                            <input type="text" class="form-control" id="validationTooltip zipcode" name="zipcode" placeholder="zipcode" required>
                            <div class="valid-tooltip">
                              Looks good!
                            </div>
                          </div>


                        </div>


                    </div>




                    <div class="form second">

                <div class="details adress">


                    <span class="sub_tittle">Education details</span>

                    <div class="fields">
                        <div class="input_field position-relative">
                            <label for="validationTooltip school_name" class="form-label">School name</label>
                            <input type="text" class="form-control" id="validationTooltip school_name" name="school_name" placeholder="School name" required>
                            <div class="valid-tooltip">
                              Looks good!
                            </div>
                          </div>


                        <div class="input_field position-relative">
                            <label for="validationTooltip level_of_qualification" class="form-label">Level of qualification</label>
                            <input type="text" class="form-control" id="validationTooltip level_of_qualification" name="level_of_qualification" placeholder="Level of qualification" required>
                            <div class="valid-tooltip">
                              Looks good!
                            </div>
                          </div>



                          <div class="input_field position-relative">
                            <label for="validationTooltip entry_date" class="form-label">Entry date</label>
                            <input type="date" class="form-control" id="validationTooltip entry_date" name="entry_date" placeholder="Entry date" required>
                            <div class="valid-tooltip">
                              Looks good!
                            </div>
                          </div>



                          <div class="input_field position-relative">
                            <label for="validationTooltip date_graduated" class="form-label">Graduated date</label>
                            <input type="date" class="form-control" id="validationTooltip date_graduated" name="date_graduated" placeholder="Date graduated" required>
                            <div class="valid-tooltip">
                              Looks good!
                            </div>
                          </div>


                          <div class="input_field position-relative">
                            <label for="validationTooltip school_addres" class="form-label">School Addres</label>
                            <input type="text" class="form-control" id="validationTooltip school_addres" name="school_addres" placeholder="School Addres" required>
                            <div class="valid-tooltip">
                              Looks good!
                            </div>
                          </div>




                          <div class="input_field">
                            <label for="Qualification_file">Qualification document</label>
                            <div class="file_icon">
                                <i class="fa-solid fa-upload"></i>
                            <input class="form-control files" type="file"  id="Qualification_file" name="Qualification_file"  aria-label="file example" required> 
                        </div>
                        <div class="invalid-feedback">Example invalid form file feedback</div>
                        </div>
                        </div>


                    </div>
                    

                </div>






                   <button class="btn btn-primary" type="submit"> <span class="btntxt">Submite</span> <i class="fa fa-forward"></i></button>
                   



                </div> 



            </div>


        </form>

      
      <!--  <script src="javascripts/application.js"></script>-->
    </div>




</body>
</html>