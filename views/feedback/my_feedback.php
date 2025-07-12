<?php
$success = $_SESSION['success'] ?? '';
$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];

unset($_SESSION['success'], $_SESSION['errors'], $_SESSION['old']);
?>
<div class="z-3 col-md-6 position-absolute pt-5 rounded-3" style="left: 50%; transform: translateX(-50%);">
    <?php if (!empty($success) || !empty($errors)): ?>
        <div id="overlay" class="overlay d-flex justify-content-center pt-1">
            <div class="alert <?= !empty($errors) ? 'alert-danger' : 'alert-success' ?> alert-dismissible fade show" role="alert" style="min-width: 300px; max-width: 90vw;">
                <?php if (!empty($errors)): ?>
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <h6><?= htmlspecialchars($error) ?></h6>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <?= htmlspecialchars($success) ?>
                <?php endif; ?>
                <button type="button" class="btn-close" aria-label="Close" onclick="hideOverlay()"></button>
            </div>
        </div>
    <?php endif; ?>
</div>


<div class="">
    <!-- Sidebar -->
    <?php
    // include __DIR__ . '/../user_sidebard.php';
    include __DIR__ . '/../user_nav.php';

    ?>
    <!-- Main content -->
    <!-- <div class="col offset-1"> -->
    <div class="col ">
        <div class=" container py-4 py-xl-5">
            <h1>My Feedback</h1>
            <hr>

            <table id="pkg_edit" class="table table-striped table-bordered text-center align-middle" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">User Name</th>
                        <th class="text-center">Country</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($Get_myfeedback)) : ?>
                        <?php foreach ($Get_myfeedback as $feedback) : ?>
                            <tr>
                                <!-- Image -->

                                <!-- Package Info -->
                                <td><?php echo htmlspecialchars($feedback['full_name']); ?></td>
                                <td>
                                    <?php
                                    include 'country.php';

                                    $code = strtolower($feedback['country']); // For flag URL
                                    $codeUpper = strtoupper($feedback['country']); // For array lookup

                                    if (isset($countryList[$codeUpper])) {
                                        $countryName = $countryList[$codeUpper]['name'];
                                        echo '<img src="https://flagcdn.com/24x18/' . $code . '.webp" alt="flag"> ' . htmlspecialchars($countryName);
                                    } else {
                                        // Code not found in list — fallback
                                        echo '<span>' . htmlspecialchars($codeUpper) . '</span>';
                                    }
                                    ?>

                                </td>
                                <td><?php echo htmlspecialchars($feedback['created_at']); ?></td>
                                <?php
                                if ($feedback['statusfeedback'] == 'active') {
                                    $color = 'success';
                                } elseif ($feedback['statusfeedback'] == 'pending') {
                                    $color = 'warning';
                                } else {
                                    $color = 'danger';
                                }

                                ?>
                                <td class="text-<?php echo $color; ?>"><i class="bi bi-circle-fill"></i></td>

                                <!-- Actions -->
                                <td class="d-flex justify-content-center align-items-center gap-2">
                                    <!-- View Button -->
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo htmlspecialchars($feedback['feedback_id']); ?>">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>

                                    <!-- edit Button -->
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?php echo htmlspecialchars($feedback['feedback_id']); ?>">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>

                                    <!-- Delete Form -->
                                    <form action="index.php?controller=feedback&action=delete_feedback" method="post" onsubmit="return confirm('Are you sure you want to delete this Package?')" style="margin: 0;">
                                        <input type="hidden" name="feedback_id" value="<?php echo htmlspecialchars($feedback['feedback_id']); ?>">
                                        <input type="hidden" name="link" value="user_feedback">
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>

                            <!-- view Modal (placed outside <tr>) -->
                            <div class="modal fade" id="exampleModal<?php echo htmlspecialchars($feedback['feedback_id']); ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?php echo htmlspecialchars($feedback['feedback_id']); ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel<?php echo htmlspecialchars($blog['blog_id']); ?>">
                                                <?php echo htmlspecialchars($feedback['full_name']); ?>
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            <p><strong>User:</strong> <?php echo htmlspecialchars($feedback['full_name']); ?></p>
                                            <p><strong>Country:</strong>
                                                <?php
                                                include 'country.php';

                                                $code = strtolower($feedback['country']); // For flag URL
                                                $codeUpper = strtoupper($feedback['country']); // For array lookup

                                                if (isset($countryList[$codeUpper])) {
                                                    $countryName = $countryList[$codeUpper]['name'];
                                                    echo '<img src="https://flagcdn.com/24x18/' . $code . '.webp" alt="flag"> ' . htmlspecialchars($countryName);
                                                } else {
                                                    // Code not found in list — fallback
                                                    echo '<span>' . htmlspecialchars($codeUpper) . '</span>';
                                                }
                                                ?></p>
                                            <hr>
                                            <p><strong>Feedback:</strong>
                                                <br>
                                                <?php echo nl2br(htmlspecialchars($feedback['review_text'])); ?>
                                            </p>
                                            <p><strong>Status:</strong><?php echo htmlspecialchars($feedback['statusfeedback']); ?></p>
                                            <p><strong>created_at:</strong><?php echo htmlspecialchars($feedback['created_at']); ?></p>
                                            <p><strong>updated_at:</strong><?php echo htmlspecialchars($feedback['updated_at']); ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ================================================================================= -->
                            <!-- edit Modal (placed outside <tr>) -->
                            <div class="modal fade" id="editModal<?php echo htmlspecialchars($feedback['feedback_id']); ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo htmlspecialchars($feedback['feedback_id']); ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel<?php echo htmlspecialchars($feedback['feedback_id']); ?>">
                                                Edit: <?php echo htmlspecialchars($feedback['full_name']); ?>
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <form class="row g-3" action="index.php?controller=feedback&action=update_feedback" method="post" id="myupdateForm" enctype="multipart/form-data">
                                                <!-- <==================================================================--  -->

                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">Country</span>
                                                    <select class="form-control form-select" id="curd_country" name="country" required>
                                                        <option value="<?php echo htmlspecialchars($feedback['country']); ?>" selected><?php echo htmlspecialchars($feedback['country']); ?> !! SELECTED</option>
                                                        <option value="AF">Afghanistan</option>
                                                        <option value="AX">Åland Islands</option>
                                                        <option value="AL">Albania</option>
                                                        <option value="DZ">Algeria</option>
                                                        <option value="AS">American Samoa</option>
                                                        <option value="AD">Andorra</option>
                                                        <option value="AO">Angola</option>
                                                        <option value="AI">Anguilla</option>
                                                        <option value="AQ">Antarctica</option>
                                                        <option value="AG">Antigua and Barbuda</option>
                                                        <option value="AR">Argentina</option>
                                                        <option value="AM">Armenia</option>
                                                        <option value="AW">Aruba</option>
                                                        <option value="AU">Australia</option>
                                                        <option value="AT">Austria</option>
                                                        <option value="AZ">Azerbaijan</option>
                                                        <option value="BS">Bahamas</option>
                                                        <option value="BH">Bahrain</option>
                                                        <option value="BD">Bangladesh</option>
                                                        <option value="BB">Barbados</option>
                                                        <option value="BY">Belarus</option>
                                                        <option value="BE">Belgium</option>
                                                        <option value="BZ">Belize</option>
                                                        <option value="BJ">Benin</option>
                                                        <option value="BM">Bermuda</option>
                                                        <option value="BT">Bhutan</option>
                                                        <option value="BO">Bolivia, Plurinational State of</option>
                                                        <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                                        <option value="BA">Bosnia and Herzegovina</option>
                                                        <option value="BW">Botswana</option>
                                                        <option value="BV">Bouvet Island</option>
                                                        <option value="BR">Brazil</option>
                                                        <option value="IO">British Indian Ocean Territory</option>
                                                        <option value="BN">Brunei Darussalam</option>
                                                        <option value="BG">Bulgaria</option>
                                                        <option value="BF">Burkina Faso</option>
                                                        <option value="BI">Burundi</option>
                                                        <option value="KH">Cambodia</option>
                                                        <option value="CM">Cameroon</option>
                                                        <option value="CA">Canada</option>
                                                        <option value="CV">Cape Verde</option>
                                                        <option value="KY">Cayman Islands</option>
                                                        <option value="CF">Central African Republic</option>
                                                        <option value="TD">Chad</option>
                                                        <option value="CL">Chile</option>
                                                        <option value="CN">China</option>
                                                        <option value="CX">Christmas Island</option>
                                                        <option value="CC">Cocos (Keeling) Islands</option>
                                                        <option value="CO">Colombia</option>
                                                        <option value="KM">Comoros</option>
                                                        <option value="CG">Congo</option>
                                                        <option value="CD">Congo, the Democratic Republic of the</option>
                                                        <option value="CK">Cook Islands</option>
                                                        <option value="CR">Costa Rica</option>
                                                        <option value="CI">Côte d'Ivoire</option>
                                                        <option value="HR">Croatia</option>
                                                        <option value="CU">Cuba</option>
                                                        <option value="CW">Curaçao</option>
                                                        <option value="CY">Cyprus</option>
                                                        <option value="CZ">Czech Republic</option>
                                                        <option value="DK">Denmark</option>
                                                        <option value="DJ">Djibouti</option>
                                                        <option value="DM">Dominica</option>
                                                        <option value="DO">Dominican Republic</option>
                                                        <option value="EC">Ecuador</option>
                                                        <option value="EG">Egypt</option>
                                                        <option value="SV">El Salvador</option>
                                                        <option value="GQ">Equatorial Guinea</option>
                                                        <option value="ER">Eritrea</option>
                                                        <option value="EE">Estonia</option>
                                                        <option value="ET">Ethiopia</option>
                                                        <option value="FK">Falkland Islands (Malvinas)</option>
                                                        <option value="FO">Faroe Islands</option>
                                                        <option value="FJ">Fiji</option>
                                                        <option value="FI">Finland</option>
                                                        <option value="FR">France</option>
                                                        <option value="GF">French Guiana</option>
                                                        <option value="PF">French Polynesia</option>
                                                        <option value="TF">French Southern Territories</option>
                                                        <option value="GA">Gabon</option>
                                                        <option value="GM">Gambia</option>
                                                        <option value="GE">Georgia</option>
                                                        <option value="DE">Germany</option>
                                                        <option value="GH">Ghana</option>
                                                        <option value="GI">Gibraltar</option>
                                                        <option value="GR">Greece</option>
                                                        <option value="GL">Greenland</option>
                                                        <option value="GD">Grenada</option>
                                                        <option value="GP">Guadeloupe</option>
                                                        <option value="GU">Guam</option>
                                                        <option value="GT">Guatemala</option>
                                                        <option value="GG">Guernsey</option>
                                                        <option value="GN">Guinea</option>
                                                        <option value="GW">Guinea-Bissau</option>
                                                        <option value="GY">Guyana</option>
                                                        <option value="HT">Haiti</option>
                                                        <option value="HM">Heard Island and McDonald Islands</option>
                                                        <option value="VA">Holy See (Vatican City State)</option>
                                                        <option value="HN">Honduras</option>
                                                        <option value="HK">Hong Kong</option>
                                                        <option value="HU">Hungary</option>
                                                        <option value="IS">Iceland</option>
                                                        <option value="IN">India</option>
                                                        <option value="ID">Indonesia</option>
                                                        <option value="IR">Iran, Islamic Republic of</option>
                                                        <option value="IQ">Iraq</option>
                                                        <option value="IE">Ireland</option>
                                                        <option value="IM">Isle of Man</option>
                                                        <option value="IL">Israel</option>
                                                        <option value="IT">Italy</option>
                                                        <option value="JM">Jamaica</option>
                                                        <option value="JP">Japan</option>
                                                        <option value="JE">Jersey</option>
                                                        <option value="JO">Jordan</option>
                                                        <option value="KZ">Kazakhstan</option>
                                                        <option value="KE">Kenya</option>
                                                        <option value="KI">Kiribati</option>
                                                        <option value="KP">Korea, Democratic People's Republic of</option>
                                                        <option value="KR">Korea, Republic of</option>
                                                        <option value="KW">Kuwait</option>
                                                        <option value="KG">Kyrgyzstan</option>
                                                        <option value="LA">Lao People's Democratic Republic</option>
                                                        <option value="LV">Latvia</option>
                                                        <option value="LB">Lebanon</option>
                                                        <option value="LS">Lesotho</option>
                                                        <option value="LR">Liberia</option>
                                                        <option value="LY">Libya</option>
                                                        <option value="LI">Liechtenstein</option>
                                                        <option value="LT">Lithuania</option>
                                                        <option value="LU">Luxembourg</option>
                                                        <option value="MO">Macao</option>
                                                        <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                                                        <option value="MG">Madagascar</option>
                                                        <option value="MW">Malawi</option>
                                                        <option value="MY">Malaysia</option>
                                                        <option value="MV">Maldives</option>
                                                        <option value="ML">Mali</option>
                                                        <option value="MT">Malta</option>
                                                        <option value="MH">Marshall Islands</option>
                                                        <option value="MQ">Martinique</option>
                                                        <option value="MR">Mauritania</option>
                                                        <option value="MU">Mauritius</option>
                                                        <option value="YT">Mayotte</option>
                                                        <option value="MX">Mexico</option>
                                                        <option value="FM">Micronesia, Federated States of</option>
                                                        <option value="MD">Moldova, Republic of</option>
                                                        <option value="MC">Monaco</option>
                                                        <option value="MN">Mongolia</option>
                                                        <option value="ME">Montenegro</option>
                                                        <option value="MS">Montserrat</option>
                                                        <option value="MA">Morocco</option>
                                                        <option value="MZ">Mozambique</option>
                                                        <option value="MM">Myanmar</option>
                                                        <option value="NA">Namibia</option>
                                                        <option value="NR">Nauru</option>
                                                        <option value="NP">Nepal</option>
                                                        <option value="NL">Netherlands</option>
                                                        <option value="NC">New Caledonia</option>
                                                        <option value="NZ">New Zealand</option>
                                                        <option value="NI">Nicaragua</option>
                                                        <option value="NE">Niger</option>
                                                        <option value="NG">Nigeria</option>
                                                        <option value="NU">Niue</option>
                                                        <option value="NF">Norfolk Island</option>
                                                        <option value="MP">Northern Mariana Islands</option>
                                                        <option value="NO">Norway</option>
                                                        <option value="OM">Oman</option>
                                                        <option value="PK">Pakistan</option>
                                                        <option value="PW">Palau</option>
                                                        <option value="PS">Palestinian Territory, Occupied</option>
                                                        <option value="PA">Panama</option>
                                                        <option value="PG">Papua New Guinea</option>
                                                        <option value="PY">Paraguay</option>
                                                        <option value="PE">Peru</option>
                                                        <option value="PH">Philippines</option>
                                                        <option value="PN">Pitcairn</option>
                                                        <option value="PL">Poland</option>
                                                        <option value="PT">Portugal</option>
                                                        <option value="PR">Puerto Rico</option>
                                                        <option value="QA">Qatar</option>
                                                        <option value="RE">Réunion</option>
                                                        <option value="RO">Romania</option>
                                                        <option value="RU">Russian Federation</option>
                                                        <option value="RW">Rwanda</option>
                                                        <option value="BL">Saint Barthélemy</option>
                                                        <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                                                        <option value="KN">Saint Kitts and Nevis</option>
                                                        <option value="LC">Saint Lucia</option>
                                                        <option value="MF">Saint Martin (French part)</option>
                                                        <option value="PM">Saint Pierre and Miquelon</option>
                                                        <option value="VC">Saint Vincent and the Grenadines</option>
                                                        <option value="WS">Samoa</option>
                                                        <option value="SM">San Marino</option>
                                                        <option value="ST">Sao Tome and Principe</option>
                                                        <option value="SA">Saudi Arabia</option>
                                                        <option value="SN">Senegal</option>
                                                        <option value="RS">Serbia</option>
                                                        <option value="SC">Seychelles</option>
                                                        <option value="SL">Sierra Leone</option>
                                                        <option value="SG">Singapore</option>
                                                        <option value="SX">Sint Maarten (Dutch part)</option>
                                                        <option value="SK">Slovakia</option>
                                                        <option value="SI">Slovenia</option>
                                                        <option value="SB">Solomon Islands</option>
                                                        <option value="SO">Somalia</option>
                                                        <option value="ZA">South Africa</option>
                                                        <option value="GS">South Georgia and the South Sandwich Islands</option>
                                                        <option value="SS">South Sudan</option>
                                                        <option value="ES">Spain</option>
                                                        <option value="LK">Sri Lanka</option>
                                                        <option value="SD">Sudan</option>
                                                        <option value="SR">Suriname</option>
                                                        <option value="SJ">Svalbard and Jan Mayen</option>
                                                        <option value="SZ">Swaziland</option>
                                                        <option value="SE">Sweden</option>
                                                        <option value="CH">Switzerland</option>
                                                        <option value="SY">Syrian Arab Republic</option>
                                                        <option value="TW">Taiwan, Province of China</option>
                                                        <option value="TJ">Tajikistan</option>
                                                        <option value="TZ">Tanzania, United Republic of</option>
                                                        <option value="TH">Thailand</option>
                                                        <option value="TL">Timor-Leste</option>
                                                        <option value="TG">Togo</option>
                                                        <option value="TK">Tokelau</option>
                                                        <option value="TO">Tonga</option>
                                                        <option value="TT">Trinidad and Tobago</option>
                                                        <option value="TN">Tunisia</option>
                                                        <option value="TR">Turkey</option>
                                                        <option value="TM">Turkmenistan</option>
                                                        <option value="TC">Turks and Caicos Islands</option>
                                                        <option value="TV">Tuvalu</option>
                                                        <option value="UG">Uganda</option>
                                                        <option value="UA">Ukraine</option>
                                                        <option value="AE">United Arab Emirates</option>
                                                        <option value="GB">United Kingdom</option>
                                                        <option value="US">United States</option>
                                                        <option value="UM">United States Minor Outlying Islands</option>
                                                        <option value="UY">Uruguay</option>
                                                        <option value="UZ">Uzbekistan</option>
                                                        <option value="VU">Vanuatu</option>
                                                        <option value="VE">Venezuela, Bolivarian Republic of</option>
                                                        <option value="VN">Viet Nam</option>
                                                        <option value="VG">Virgin Islands, British</option>
                                                        <option value="VI">Virgin Islands, U.S.</option>
                                                        <option value="WF">Wallis and Futuna</option>
                                                        <option value="EH">Western Sahara</option>
                                                        <option value="YE">Yemen</option>
                                                        <option value="ZM">Zambia</option>
                                                        <option value="ZW">Zimbabwe</option>
                                                    </select>
                                                </div>
                                                <!-- <==================================================================--  -->
                                                <div class="input-group mb-3">

                                                    <span class="input-group-text" id="basic-addon1">Review Text</span>
                                                    <textarea class="form-control " id="review_text" name="review_text" rows="4" maxlength="200" placeholder="Write your feedback..." required><?php echo htmlspecialchars($feedback['review_text']); ?></textarea>

                                                </div>
                                                <!-- <==================================================================--  -->


                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="feedback_id" value="<?php echo htmlspecialchars($feedback['feedback_id']); ?>">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <input type="hidden" name="link" value="user_feedback">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <!-- <tr> -->
                        <p colspan="4" class="text-center">No feedback Found!</p>
                        <!-- </tr> -->
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#blog_form').parsley();
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const lightbox = GLightbox({
            selector: '.glightbox',
            closeButton: true,
            loop: true,
            touchNavigation: true,
            keyboardNavigation: true
        });
        console.log(lightbox);
        console.log(document.querySelectorAll('.glightbox'));
    });
</script>