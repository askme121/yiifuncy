<?php
use yii\helpers\Url;

$this->title = $meta['title'];
$this->registerMetaTag(array("name"=>"description","content"=>$meta['description']));
$this->registerMetaTag(array("name"=>"keywords","content"=>$meta['keyword']));
?>
<div class="split"></div>
<div class="container">
    <div class="container-bg">
        <?= $this->render('../public/userleftbar.php') ?>
        <div class="account-content-container">
            <ul id="deal-detal-tab" class="nav nav-tabs">
                <li role="presentation" id="tab-profile" class="in active">
                    <a href="#my-profile" data-toggle="tab" data-type="signin">My Profile</a>
                </li>

                <li role="presentation" id="tab-profile-link">
                    <a href="#amazon-profile" data-toggle="tab" data-type="signup">Paypal &amp; Amazon Profile</a>
                </li>
                <li role="presentation" id="tab-change-passs">
                    <a href="#change-pass" data-toggle="tab" data-type="signup">Change Password</a>
                </li>
            </ul>
            <div id="account-tab-content" class="tab-content">
                <div class="tab-pane fade in active" id="my-profile">
                    <div class="visible-lg visible-md" style="border-bottom: 1px solid #F6F6F6;overflow: hidden;position: relative;">
                        <button type="button" class="btn btn-lg upload-img jq-upload-img" data-toggle="modal" data-target=".upload-img-modal" style="background: url(<?= getImgUrl('images/user.png') ?>) center center / cover;">
                            <div id="layer-upimg-container" style="display: none;">
                                <div class="layer-masks"></div>
                                <div class="layer-contents" style="font-size:12px;">UPLOAD an IMAGE</div>
                            </div>
                        </button>
                        <div class="uporder-succ-tip">Avatar Upload Success!</div>
                    </div>
                    <form class="public-profile" action="/account/profile" method="post" id="public-profile-form">
                        <input name="avatar" type="hidden" value="">
                        <div class="row">
                            <dl class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <dt>First Name(Display on the reviews page)</dt>
                                <dd>
                                    <input name="first_name" type="text" class="form-control" value="ask" oninput="checkField(this,this.value)" onporpertychange="checkField(this,this.value)">
                                </dd>
                                <div class="error" id="firstName-tip" style="display: none;">Please fill out this field</div>
                            </dl>
                            <dl class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <dt>Last Name(Display on the reviews page)</dt>
                                <dd>
                                    <input name="last_name" type="text" class="form-control" value="me" oninput="checkField(this,this.value)" onporpertychange="checkField(this,this.value)">
                                </dd>
                                <div class="error" id="lastName-tip" style="display: none;">Please fill out this field</div>
                            </dl>
                        </div>
                        <div class="row">
                            <dl class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <dt>Gender</dt>
                                <dd class="radio-container">
                                    <select name="gender" class="form-control">
                                        <option value=""></option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Transgender">Transgender</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </dd>
                            </dl>
                            <dl class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <dt>Date of Birth</dt>
                                <dd>
                                    <select class="sel_month form-control birth-select " rel="" name="birth_month">
                                        <option value="">Month</option>                                                                                                                                     <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                    <select class="sel_day form-control birth-select" rel="" name="birth_day">
                                        <option value="">Day</option>                                                                                                                                     <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                    </select>
                                    <select class="sel_year form-control birth-select" rel="" name="birth_year">
                                        <option value="">Year</option>
                                        <option value="2019">2019</option>
                                        <option value="2018">2018</option>
                                        <option value="2017">2017</option>
                                        <option value="2016">2016</option>
                                        <option value="2015">2015</option>
                                        <option value="2014">2014</option>
                                        <option value="2013">2013</option>
                                        <option value="2012">2012</option>
                                        <option value="2011">2011</option>
                                        <option value="2010">2010</option>
                                        <option value="2009">2009</option>
                                        <option value="2008">2008</option>
                                        <option value="2007">2007</option>
                                        <option value="2006">2006</option>
                                        <option value="2005">2005</option>
                                        <option value="2004">2004</option>
                                        <option value="2003">2003</option>
                                        <option value="2002">2002</option>
                                        <option value="2001">2001</option>
                                        <option value="2000">2000</option>
                                        <option value="1999">1999</option>
                                        <option value="1998">1998</option>
                                        <option value="1997">1997</option>
                                        <option value="1996">1996</option>
                                        <option value="1995">1995</option>
                                        <option value="1994">1994</option>
                                        <option value="1993">1993</option>
                                        <option value="1992">1992</option>
                                        <option value="1991">1991</option>
                                        <option value="1990">1990</option>
                                        <option value="1989">1989</option>
                                        <option value="1988">1988</option>
                                        <option value="1987">1987</option>
                                        <option value="1986">1986</option>
                                        <option value="1985">1985</option>
                                        <option value="1984">1984</option>
                                        <option value="1983">1983</option>
                                        <option value="1982">1982</option>
                                        <option value="1981">1981</option>
                                        <option value="1980">1980</option>
                                        <option value="1979">1979</option>
                                        <option value="1978">1978</option>
                                        <option value="1977">1977</option>
                                        <option value="1976">1976</option>
                                        <option value="1975">1975</option>
                                        <option value="1974">1974</option>
                                        <option value="1973">1973</option>
                                        <option value="1972">1972</option>
                                        <option value="1971">1971</option>
                                        <option value="1970">1970</option>
                                        <option value="1969">1969</option>
                                        <option value="1968">1968</option>
                                        <option value="1967">1967</option>
                                        <option value="1966">1966</option>
                                        <option value="1965">1965</option>
                                        <option value="1964">1964</option>
                                        <option value="1963">1963</option>
                                        <option value="1962">1962</option>
                                        <option value="1961">1961</option>
                                        <option value="1960">1960</option>
                                        <option value="1959">1959</option>
                                        <option value="1958">1958</option>
                                        <option value="1957">1957</option>
                                        <option value="1956">1956</option>
                                        <option value="1955">1955</option>
                                        <option value="1954">1954</option>
                                        <option value="1953">1953</option>
                                        <option value="1952">1952</option>
                                        <option value="1951">1951</option>
                                        <option value="1950">1950</option>
                                        <option value="1949">1949</option>
                                        <option value="1948">1948</option>
                                        <option value="1947">1947</option>
                                        <option value="1946">1946</option>
                                        <option value="1945">1945</option>
                                        <option value="1944">1944</option>
                                        <option value="1943">1943</option>
                                        <option value="1942">1942</option>
                                        <option value="1941">1941</option>
                                        <option value="1940">1940</option>
                                        <option value="1939">1939</option>
                                        <option value="1938">1938</option>
                                        <option value="1937">1937</option>
                                        <option value="1936">1936</option>
                                        <option value="1935">1935</option>
                                        <option value="1934">1934</option>
                                        <option value="1933">1933</option>
                                        <option value="1932">1932</option>
                                        <option value="1931">1931</option>
                                        <option value="1930">1930</option>
                                        <option value="1929">1929</option>
                                        <option value="1928">1928</option>
                                        <option value="1927">1927</option>
                                        <option value="1926">1926</option>
                                        <option value="1925">1925</option>
                                        <option value="1924">1924</option>
                                        <option value="1923">1923</option>
                                        <option value="1922">1922</option>
                                        <option value="1921">1921</option>
                                        <option value="1920">1920</option>
                                    </select>
                                </dd>
                            </dl>
                        </div>
                        <div class="row">
                            <dl class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <dt>Country</dt>
                                <dd>
                                    <select name="country" class="form-control" id="country-select" data-country="">
                                        <option value=""></option>
                                        <option value="United States(US)">United States(US)</option>
                                        <option value="Afghanistan(AF)">Afghanistan(AF)</option>
                                        <option value="Aland Islands(AX)">Aland Islands(AX)</option>
                                        <option value="Albania(AL)">Albania(AL)</option>
                                        <option value="Algeria(DZ)">Algeria(DZ)</option>
                                        <option value="American Samoa(AS)">American Samoa(AS)</option>
                                        <option value="Andorra(AD)">Andorra(AD)</option>
                                        <option value="Angola(AO)">Angola(AO)</option>
                                        <option value="Anguilla(AI)">Anguilla(AI)</option>
                                        <option value="Antigua and Barbuda(AG)">Antigua and Barbuda(AG)</option>
                                        <option value="Argentina(AR)">Argentina(AR)</option>
                                        <option value="Armenia(AM)">Armenia(AM)</option>
                                        <option value="Aruba(AW)">Aruba(AW)</option>
                                        <option value="Australia(AU)">Australia(AU)</option>
                                        <option value="Austria(AT)">Austria(AT)</option>
                                        <option value="Azerbaijan(AZ)">Azerbaijan(AZ)</option>
                                        <option value="Bangladesh(BD)">Bangladesh(BD)</option>
                                        <option value="Bahrain(BH)">Bahrain(BH)</option>
                                        <option value="Bahamas(BS)">Bahamas(BS)</option>
                                        <option value="Barbados(BB)">Barbados(BB)</option>
                                        <option value="Belarus(BY)">Belarus(BY)</option>
                                        <option value="Belgium(BE)">Belgium(BE)</option>
                                        <option value="Belize(BZ)">Belize(BZ)</option>
                                        <option value="Benin(BJ)">Benin(BJ)</option>
                                        <option value="Bermuda(BM)">Bermuda(BM)</option>
                                        <option value="Bhutan(BT)">Bhutan(BT)</option>
                                        <option value="Bolivia(BO)">Bolivia(BO)</option>
                                        <option value="Bosnia and Herzegovina(BA)">Bosnia and Herzegovina(BA)</option>
                                        <option value="Botswana(BW)">Botswana(BW)</option>
                                        <option value="Bouvet Island(BV)">Bouvet Island(BV)</option>
                                        <option value="Brazil(BR)">Brazil(BR)</option>
                                        <option value="Brunei(BN)">Brunei(BN)</option>
                                        <option value="Bulgaria(BG)">Bulgaria(BG)</option>
                                        <option value="Burkina Faso(BF)">Burkina Faso(BF)</option>
                                        <option value="Burundi(BI)">Burundi(BI)</option>
                                        <option value="Cambodia(KH)">Cambodia(KH)</option>
                                        <option value="Cameroon(CM)">Cameroon(CM)</option>
                                        <option value="Canada(CA)">Canada(CA)</option>
                                        <option value="Cape Verde(CV)">Cape Verde(CV)</option>
                                        <option value="Central African Republic(CF)">Central African Republic(CF)</option>
                                        <option value="Chad(TD)">Chad(TD)</option>
                                        <option value="Chile(CL)">Chile(CL)</option>
                                        <option value="Christmas Islands(CX)">Christmas Islands(CX)</option>
                                        <option value="Cocos (keeling) Islands(CC)">Cocos (keeling) Islands(CC)</option>
                                        <option value="Colombia(CO)">Colombia(CO)</option>
                                        <option value="Comoros(KM)">Comoros(KM)</option>
                                        <option value="Congo (Congo-Kinshasa)(CD)">Congo (Congo-Kinshasa)(CD)</option>
                                        <option value="Congo(CG)">Congo(CG)</option>
                                        <option value="Cook Islands(CK)">Cook Islands(CK)</option>
                                        <option value="Costa Rica(CR)">Costa Rica(CR)</option>
                                        <option value="Cote D'Ivoire(CI)">Cote D'Ivoire(CI)</option>
                                        <option value="China(CN)">China(CN)</option>
                                        <option value="Croatia(HR)">Croatia(HR)</option>
                                        <option value="Cuba(CU)">Cuba(CU)</option>
                                        <option value="Czech(CZ)">Czech(CZ)</option>
                                        <option value="Cyprus(CY)">Cyprus(CY)</option>
                                        <option value="Denmark(DK)">Denmark(DK)</option>
                                        <option value="Djibouti(DJ)">Djibouti(DJ)</option>
                                        <option value="Dominica(DM)">Dominica(DM)</option>
                                        <option value="East Timor()">East Timor()</option>
                                        <option value="Ecuador(EC)">Ecuador(EC)</option>
                                        <option value="Egypt(EG)">Egypt(EG)</option>
                                        <option value="Equatorial Guinea(GQ)">Equatorial Guinea(GQ)</option>
                                        <option value="Eritrea(ER)">Eritrea(ER)</option>
                                        <option value="Estonia(EE)">Estonia(EE)</option>
                                        <option value="Ethiopia(ET)">Ethiopia(ET)</option>
                                        <option value="Faroe Islands(FO)">Faroe Islands(FO)</option>
                                        <option value="Fiji(FJ)">Fiji(FJ)</option>
                                        <option value="Finland(FI)">Finland(FI)</option>
                                        <option value="France(FR)">France(FR)</option>
                                        <option value="MetropolitanFrance(FX)">MetropolitanFrance(FX)</option>
                                        <option value="French Guiana(GF)">French Guiana(GF)</option>
                                        <option value="French Polynesia(PF)">French Polynesia(PF)</option>
                                        <option value="Gabon(GA)">Gabon(GA)</option>
                                        <option value="Gambia(GM)">Gambia(GM)</option>
                                        <option value="Georgia(GE)">Georgia(GE)</option>
                                        <option value="Germany(DE)">Germany(DE)</option>
                                        <option value="Ghana(GH)">Ghana(GH)</option>
                                        <option value="Gibraltar(GI)">Gibraltar(GI)</option>
                                        <option value="Greece(GR)">Greece(GR)</option>
                                        <option value="Grenada(GD)">Grenada(GD)</option>
                                        <option value="Guadeloupe(GP)">Guadeloupe(GP)</option>
                                        <option value="Guam(GU)">Guam(GU)</option>
                                        <option value="Guatemala(GT)">Guatemala(GT)</option>
                                        <option value="Guernsey(GG)">Guernsey(GG)</option>
                                        <option value="Guinea-Bissau(GW)">Guinea-Bissau(GW)</option>
                                        <option value="Guinea(GN)">Guinea(GN)</option>
                                        <option value="Guyana(GY)">Guyana(GY)</option>
                                        <option value="Haiti(HT)">Haiti(HT)</option>
                                        <option value="Honduras(HN)">Honduras(HN)</option>
                                        <option value="Hungary(HU)">Hungary(HU)</option>
                                        <option value="Iceland(IS)">Iceland(IS)</option>
                                        <option value="India(IN)">India(IN)</option>
                                        <option value="Indonesia(ID)">Indonesia(ID)</option>
                                        <option value="Iran(IR)">Iran(IR)</option>
                                        <option value="Iraq(IQ)">Iraq(IQ)</option>
                                        <option value="Ireland(IE)">Ireland(IE)</option>
                                        <option value="Isle of Man(IM)">Isle of Man(IM)</option>
                                        <option value="Israel(IL)">Israel(IL)</option>
                                        <option value="Italy(IT)">Italy(IT)</option>
                                        <option value="Jamaica(JM)">Jamaica(JM)</option>
                                        <option value="Japan(JP)">Japan(JP)</option>
                                        <option value="Jersey(JE)">Jersey(JE)</option>
                                        <option value="Jordan(JO)">Jordan(JO)</option>
                                        <option value="Kazakhstan(KZ)">Kazakhstan(KZ)</option>
                                        <option value="Kenya(KE)">Kenya(KE)</option>
                                        <option value="Kiribati(KI)">Kiribati(KI)</option>
                                        <option value="Korea (South)(KR)">Korea (South)(KR)</option>
                                        <option value="Korea (North)(KD)">Korea (North)(KD)</option>
                                        <option value="Kuwait(KW)">Kuwait(KW)</option>
                                        <option value="Kyrgyzstan(KG)">Kyrgyzstan(KG)</option>
                                        <option value="Laos(LO)">Laos(LO)</option>
                                        <option value="Latvia(LV)">Latvia(LV)</option>
                                        <option value="Lebanon(LB)">Lebanon(LB)</option>
                                        <option value="Lesotho(LS)">Lesotho(LS)</option>
                                        <option value="Liberia(LR)">Liberia(LR)</option>
                                        <option value="Libya(LY)">Libya(LY)</option>
                                        <option value="Liechtenstein(LI)">Liechtenstein(LI)</option>
                                        <option value="Lithuania(LT)">Lithuania(LT)</option>
                                        <option value="Luxembourg(LU)">Luxembourg(LU)</option>
                                        <option value="Macedonia(MK)">Macedonia(MK)</option>
                                        <option value="Malawi(MW)">Malawi(MW)</option>
                                        <option value="Malaysia(MY)">Malaysia(MY)</option>
                                        <option value="Madagascar(MG)">Madagascar(MG)</option>
                                        <option value="Maldives(MV)">Maldives(MV)</option>
                                        <option value="Mali(ML)">Mali(ML)</option>
                                        <option value="Malta(MT)">Malta(MT)</option>
                                        <option value="Marshall Islands(MH)">Marshall Islands(MH)</option>
                                        <option value="Martinique(MQ)">Martinique(MQ)</option>
                                        <option value="Mauritania(MR)">Mauritania(MR)</option>
                                        <option value="Mauritius(MU)">Mauritius(MU)</option>
                                        <option value="Mayotte(YT)">Mayotte(YT)</option>
                                        <option value="Mexico(MX)">Mexico(MX)</option>
                                        <option value="Micronesia(MF)">Micronesia(MF)</option>
                                        <option value="Moldova(MD)">Moldova(MD)</option>
                                        <option value="Monaco(MC)">Monaco(MC)</option>
                                        <option value="Mongolia(MN)">Mongolia(MN)</option>
                                        <option value="Montenegro(ME)">Montenegro(ME)</option>
                                        <option value="Montserrat(MS)">Montserrat(MS)</option>
                                        <option value="Morocco(MA)">Morocco(MA)</option>
                                        <option value="Mozambique(MZ)">Mozambique(MZ)</option>
                                        <option value="Myanmar(MM)">Myanmar(MM)</option>
                                        <option value="Namibia(NA)">Namibia(NA)</option>
                                        <option value="Nauru(NR)">Nauru(NR)</option>
                                        <option value="Nepal(NP)">Nepal(NP)</option>
                                        <option value="Netherlands(NL)">Netherlands(NL)</option>
                                        <option value="New Caledonia(NC)">New Caledonia(NC)</option>
                                        <option value="New Zealand(NZ)">New Zealand(NZ)</option>
                                        <option value="Nicaragua(NI)">Nicaragua(NI)</option>
                                        <option value="Niger(NE)">Niger(NE)</option>
                                        <option value="Nigeria(NG)">Nigeria(NG)</option>
                                        <option value="Niue(NU)">Niue(NU)</option>
                                        <option value="Norfolk Island(NF)">Norfolk Island(NF)</option>
                                        <option value="Norway(NO)">Norway(NO)</option>
                                        <option value="Oman(OM)">Oman(OM)</option>
                                        <option value="Pakistan(PK)">Pakistan(PK)</option>
                                        <option value="Palau(PW)">Palau(PW)</option>
                                        <option value="Palestine(PS)">Palestine(PS)</option>
                                        <option value="Panama(PA)">Panama(PA)</option>
                                        <option value="Papua New Guinea(PG)">Papua New Guinea(PG)</option>
                                        <option value="Peru(PE)">Peru(PE)</option>
                                        <option value="Philippines(PH)">Philippines(PH)</option>
                                        <option value="Pitcairn Islands(PN)">Pitcairn Islands(PN)</option>
                                        <option value="Poland(PL)">Poland(PL)</option>
                                        <option value="Portugal(PT)">Portugal(PT)</option>
                                        <option value="Puerto Rico(PR)">Puerto Rico(PR)</option>
                                        <option value="Qatar(QA)">Qatar(QA)</option>
                                        <option value="Reunion(RE)">Reunion(RE)</option>
                                        <option value="Romania(RO)">Romania(RO)</option>
                                        <option value="Rwanda(RW)">Rwanda(RW)</option>
                                        <option value="Russian Federation(RU)">Russian Federation(RU)</option>
                                        <option value="Saint Helena(SH)">Saint Helena(SH)</option>
                                        <option value="Saint Kitts-Nevis(KN)">Saint Kitts-Nevis(KN)</option>
                                        <option value="Saint Lucia(LC)">Saint Lucia(LC)</option>
                                        <option value="Saint Vincent and the Grenadines(VG)">Saint Vincent and the Grenadines(VG)</option>
                                        <option value="El Salvador(SV)">El Salvador(SV)</option>
                                        <option value="Samoa(WS)">Samoa(WS)</option>
                                        <option value="San Marino(SM)">San Marino(SM)</option>
                                        <option value="Sao Tome and Principe(ST)">Sao Tome and Principe(ST)</option>
                                        <option value="Saudi Arabia(SA)">Saudi Arabia(SA)</option>
                                        <option value="Senegal(SN)">Senegal(SN)</option>
                                        <option value="Seychelles(SC)">Seychelles(SC)</option>
                                        <option value="Sierra Leone(SL)">Sierra Leone(SL)</option>
                                        <option value="Singapore(SG)">Singapore(SG)</option>
                                        <option value="Serbia(RS)">Serbia(RS)</option>
                                        <option value="Slovakia(SK)">Slovakia(SK)</option>
                                        <option value="Slovenia(SI)">Slovenia(SI)</option>
                                        <option value="Solomon Islands(SB)">Solomon Islands(SB)</option>
                                        <option value="Somalia(SO)">Somalia(SO)</option>
                                        <option value="South Africa(ZA)">South Africa(ZA)</option>
                                        <option value="Spain(ES)">Spain(ES)</option>
                                        <option value="Sri Lanka(LK)">Sri Lanka(LK)</option>
                                        <option value="Sudan(SD)">Sudan(SD)</option>
                                        <option value="Suriname(SR)">Suriname(SR)</option>
                                        <option value="Swaziland(SZ)">Swaziland(SZ)</option>
                                        <option value="Sweden(SE)">Sweden(SE)</option>
                                        <option value="Switzerland(CH)">Switzerland(CH)</option>
                                        <option value="Syria(SY)">Syria(SY)</option>
                                        <option value="Tajikistan(TJ)">Tajikistan(TJ)</option>
                                        <option value="Tanzania(TZ)">Tanzania(TZ)</option>
                                        <option value="Thailand(TH)">Thailand(TH)</option>
                                        <option value="Trinidad and Tobago(TT)">Trinidad and Tobago(TT)</option>
                                        <option value="Timor-Leste(TL)">Timor-Leste(TL)</option>
                                        <option value="Togo(TG)">Togo(TG)</option>
                                        <option value="Tokelau(TK)">Tokelau(TK)</option>
                                        <option value="Tonga(TO)">Tonga(TO)</option>
                                        <option value="Tunisia(TN)">Tunisia(TN)</option>
                                        <option value="Turkey(TR)">Turkey(TR)</option>
                                        <option value="Turkmenistan(TM)">Turkmenistan(TM)</option>
                                        <option value="Tuvalu(TV)">Tuvalu(TV)</option>
                                        <option value="Uganda(UG)">Uganda(UG)</option>
                                        <option value="Ukraine(UA)">Ukraine(UA)</option>
                                        <option value="United Arab Emirates(AE)">United Arab Emirates(AE)</option>
                                        <option value="United Kingdom(UK)">United Kingdom(UK)</option>
                                        <option value="Uruguay(UY)">Uruguay(UY)</option>
                                        <option value="Uzbekistan(UZ)">Uzbekistan(UZ)</option>
                                        <option value="Vanuatu(VN)">Vanuatu(VN)</option>
                                        <option value="Vatican City(VA)">Vatican City(VA)</option>
                                        <option value="Venezuela(VE)">Venezuela(VE)</option>
                                        <option value="Vietnam(VN)">Vietnam(VN)</option>
                                        <option value="Wallis and Futuna(WF)">Wallis and Futuna(WF)</option>
                                        <option value="Western Sahara(EH)">Western Sahara(EH)</option>
                                        <option value="Yemen(YE)">Yemen(YE)</option>
                                        <option value="Yugoslavia(YU)">Yugoslavia(YU)</option>
                                        <option value="Zambia(ZM)">Zambia(ZM)</option>
                                        <option value="Zimbabwe(ZW)">Zimbabwe(ZW)</option>
                                    </select>
                                </dd>
                            </dl>
                            <dl class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <dt>Marital Status</dt>
                                <dd>
                                    <select name="marital_status" class="form-control">
                                        <option value=""></option>
                                        <option value="married">Married</option>
                                        <option value="single">Single</option>
                                        <option value="separated">Separated</option>
                                        <option value="divorced">Divorced</option>
                                        <option value="widowed">Widowed</option>
                                    </select>
                                </dd>
                            </dl>
                        </div>
                        <div class="row">
                            <dl class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <dt>Preferred Product Categories</dt>
                                <dd>
                                    <select name="like_product" class="form-control">
                                        <option value=""></option>
                                        <option value="Electronics &amp; Computers &amp; Office">Electronics, Computers &amp; Office</option>
                                        <option value="Home &amp; Garden &amp; Pets &amp; Tools">Home, Garden, Pets &amp; Tools</option>
                                        <option value="Food &amp; Grocery">Food &amp; Grocery</option>
                                        <option value="Beauty &amp; Health">Beauty &amp; Health</option>
                                        <option value="Toys &amp; Kids &amp; Babies">Toys, Kids &amp; Baby</option>
                                        <option value="Clothing &amp; Shoes &amp; Jewelry">Clothing, Shoes &amp; Jewelry</option>
                                        <option value="Handmade">Handmade</option>
                                        <option value="Sports &amp; Outdoors">Sports &amp; Outdoors</option>
                                        <option value="Automotive &amp; Industrial">Automotive &amp; Industrial</option>
                                    </select>
                                </dd>
                            </dl>
                            <dl class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <dt>Education(The Highest Level)</dt>
                                <dd>
                                    <select name="highest_education" class="form-control">
                                        <option value=""></option>
                                        <option value="Less than High School">Less than High School</option>
                                        <option value="Some High School">Some High School</option>
                                        <option value="High School Diploma or Equivalent">High School Diploma or Equivalent</option>
                                        <option value="Some College">Some College</option>
                                        <option value="Associate Degree">Associate Degree</option>
                                        <option value="Bachelor’s Degree">Bachelor’s Degree</option>
                                        <option value="Master’s Degree">Master’s Degree</option>
                                        <option value="Doctorate Degree">Doctorate Degree</option>
                                        <option value="None of the Above">None of the Above</option>
                                    </select>
                                </dd>
                            </dl>
                        </div>
                        <div class="row">
                            <dl class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <dt>Annually Cost for Online Shopping</dt>
                                <dd>
                                    <select name="online_shopping_spend" class="form-control">
                                        <option value=""></option>
                                        <option value="Under $250">Under $250</option>
                                        <option value="$250 to $500">$250 to $500</option>
                                        <option value="$500 to $1000">$500 to $1000</option>
                                        <option value="$1,000 to $5,000">$1,000 to $5,000</option>
                                        <option value="$5,000 or more">$5,000 or more</option>
                                    </select>
                                </dd>
                            </dl>
                            <dl class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <dt>Total Household Income Before Taxes</dt>
                                <dd>
                                    <select name="household" class="form-control">
                                        <option value=""></option>
                                        <option value="Under $2,5000">Under $2,5000</option>
                                        <option value="$25,000 to $50,000">$25,000 to $50,000</option>
                                        <option value="$50,000 to $75,000">$50,000 to $75,000</option>
                                        <option value="$75,000 to $100,000">$75,000 to $100,000</option>
                                        <option value="$100,000 or more">$100,000 or more</option>
                                    </select>
                                </dd>
                            </dl>
                        </div>
                        <div class="row">

                        </div>
                        <p class="col-md-12 col-sm-12 col-xs-12" style="padding: 0 !important;margin: 0;">
                            <input type="button" class="btn upOrder-form-btn" id="update-profile" value="Submit">
                        </p>
                    </form>
                </div>

                <div class="tab-pane fade" id="change-pass">
                    <form class="changepassword-form" id="changepassword-form" action="/account/password" method="post">
                        <div class="form-group">
                            <label><font style="color: red;">*</font>Old Password: </label>
                            <input id="old-password" name="old_password" type="password" class="form-control">
                            <span class="help-block m-b-none error" style="margin-left: 174px; color: #ed5565;"></span>
                        </div>
                        <div class="form-group">
                            <label><font style="color: red;">*</font>New Password: </label>
                            <input id="new-pass" name="new_password" type="password" class="form-control">
                            <span class="help-block m-b-none error" style="margin-left: 174px; color: #ed5565;"></span>
                        </div>
                        <div class="form-group">
                            <label><font style="color: red;">*</font>Confirm Password: </label>
                            <input id="new-password-confirmation" name="new_password_confirmation" type="password" class="form-control">
                            <span class="help-block m-b-none error" style="margin-left: 174px; color: #ed5565;"></span>
                        </div>
                        <span class="help-block m-b-none error" style="margin-left: 174px; color: #ed5565;"></span>
                        <p class="form-group">
                            <label></label>
                            <input type="submit" class="btn upOrder-form-btn" id="submit-password" value="Submit" style="margin-top: 10px; line-height: 10px;">
                        </p>
                    </form>
                </div>
                <div class="tab-pane fade" id="amazon-profile">

                    <form class="submit-amazon-profile-form" id="submit-amazon-profile-form" style="margin-left: 20px;" action="/account/amazon_profile_link?type=redirect&amp;url=" method="POST">
                        <ul class="profile-list" style="margin-top: 20px;">
                            <li>
                                <span class="method-dot">1</span>
                                Click the Amazon profile URL: <a class="method-link" href="https://www.amazon.com/gp/profile?ref_=ya_d_l_profile" target="_blank">https://www.amazon.com/gp/profile?ref_=ya_d_l_profile</a>
                            </li>
                            <li>
                                <span class="method-dot">2</span>
                                Sign in your amazon account
                            </li>
                            <li>
                                <span class="method-dot">3</span>Copy and submit your Profile Url<br>
                                <img src="<?= getImgUrl('images/profile-link-example.png') ?>" width="72%" style="margin-top: 5px;">
                            </li>
                        </ul>
                        <div class="form-group" style="margin-bottom: 0;">
                            <label>Amazon Profile URL: </label>
                            <input name="amazon_profile_link" type="text" class="form-control" value="">
                            <span class="help-block m-b-none" style="margin-left: 0px; color: #ed5565;"></span>
                        </div>
                        <div class="form-group">
                            <label>Paypal Account:<button type="button" class="btn-default question-icon" data-toggle="tooltip" title="" data-original-title="Refund PayPal Account (can’t be changed), PayPal account must be an email">?</button></label>
                            <input name="paypal" type="email" class="form-control jq-add-paypal" value="" placeholder="PayPal account must be an email">
                            <span class="help-block m-b-none" style="margin-left: 0px; color: #ed5565;"></span>
                        </div>
                        <p class="form-group">
                            <label></label>
                            <input type="submit" class="btn upOrder-form-btn" id="submit-amazon-link" value="Save" style="margin-top: 10px; line-height: 10px;">
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal upload-img-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 530px !important;">
            <button type="button" class="close model-close" id="close-btn" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>

            <div class="modal-body">
                <p class="upload-img-title">Upload an profile picture</p>
                <div class="modal-content-upimg">
                    <div style="overflow: hidden;">
                        <div class="user-img-containers">
                            <div class="blah-img">
                                <img id="blah" alt="your image" src="<?= getImgUrl('images/mosaic.png') ?>" style="width: 100%;" />
                            </div>
                            <p class="upimg-tip">Tips: Upload an image in the JPEG format, less than 2 MB. Your image will be automatically cropped and resized to 100*100 pixels.</p>
                        </div>

                        <div style="float: right;display: inline-block;width: 120px;">
                            <div class="img-preview img-preview" id="cropped_result"></div>
                            <p style="text-align: center;margin-bottom: 116px;">image preview</p>
                            <a href="javascript:;" class="upload" style="width: 120px;font-size: 14px;">
                                <input type="file" class="change" name="image" id="image"accept="image/png, image/jpeg, image/jpg" size="25" class="usp-input usp-clone" onchange="readURL(this);"/>
                                Upload an Image
                            </a>
                        </div>
                    </div>
                    <div id="maxsize-error" class="error" style=" margin-bottom: 20px;display: none;text-align: center;"></div>
                </div>
                <div style="border-top: 1px solid #F1F1F1;padding-top: 25px;padding-bottom: 15px;">
                    <button type="button" class="btn model-close upOrder-form-btn" id="upimg-cancel" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">Cancel</span>
                    </button>
                    <input type="submit" class="btn upOrder-form-btn" id="crop_button" value="Save" style="margin-left: 77px;display: none !important;">
                </div>
            </div>
        </div>
    </div>
</div>

<button type="button" class="btn" id="profile-complete-tip" data-toggle="modal" data-target=".profile-complete-tip" style="display: none;"></button>
<div class="modal profile-complete-tip" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close model-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>

            <div class="modal-body" style="padding: 40px 68px;">
                <p class="alert alert-info" role="alert" style="margin: 10px 0 30px;text-align: center;">
                    Fill in all the information can get 500 points!
                </p>
                <div style="text-align: center;">
                    <button class="btn operation-btn" id="profile-submit-btn" data-url="#" style="float: none;display: inline-block;margin: 0;line-height: 1;">Submit</button>

                    <button class="btn upOrder-form-btn" data-dismiss="modal" aria-label="Close" id="fill-all-btn" style="width:144px;margin: 0 0 0 60px;font-weight: normal;">Continue to fill</button>
                </div>
            </div>
        </div>
    </div>
</div>