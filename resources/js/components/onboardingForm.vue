<template>
    <div v-if="!submitted" class="mt-8 mb-24 mx-auto w-fit px-12 pb-10 rounded-xl shadow-newdrop bg-white">
        <!--Progress Bar-->
        <div class="py-6">
            <p v-if="currentStep === 0" class="text-center font-light mb-4"><span class="text-custom-blue">0%</span> Completed</p>
            <p v-else-if="currentStep === 1" class="text-center font-light mb-4"><span class="text-custom-blue">35%</span> Completed</p>
            <p v-else-if="currentStep === 2" class="text-center font-light mb-4"><span class="text-custom-blue">65%</span> Completed</p>
            <p v-else-if="currentStep === 3" class="text-center font-light mb-4"><span class="text-custom-blue">80%</span> Completed</p>
            <p v-else-if="currentStep === 4" class="text-center font-light mb-4"><span class="text-custom-blue">95%</span> Completed</p>
            <div class="w-[680px]">
                <div class="w-full bg-custom-light-blue h-4 mb-2 rounded-full">
                    <div v-if="currentStep === 0" class="bg-custom-blue h-4 rounded-full" style="width: 0%"></div>
                    <div v-else-if="currentStep === 1" class="bg-custom-blue h-4 rounded-full" style="width: 35%"></div>
                    <div v-else-if="currentStep === 2" class="bg-custom-blue h-4 rounded-full" style="width: 65%"></div>
                    <div v-else-if="currentStep === 3" class="bg-custom-blue h-4 rounded-full" style="width: 80%"></div>
                    <div v-else-if="currentStep === 4" class="bg-custom-blue h-4 rounded-full" style="width: 95%"></div>
                </div>
            </div>
        </div>

        <!--Agency Info-->
        <div v-if="currentStep === 0" class="grid py-6 w-fit mx-auto justify-items-center">
            <h2 class="text-[25px] font-semibold text-custom-gray text-center">Agency Information</h2>

            <div class="grid w-[680px] mx-auto mt-8 gap-4">
                <!--Agent Name-->
                <div class="grid grid-cols-2 gap-[80px]">
                    <!--First Name-->
                    <div class="grid col gap-2">
                        <input v-model="v$.onboardingInformation.first_name.$model" :class="{'border-red-400 focus:border-red-400 focus:ring-red-400': v$.onboardingInformation.first_name.$error, 'border-custom-blue focus:border-custom-blue focus:ring-custom-blue': !v$.onboardingInformation.first_name.$error}" type="text" name="first_name" id="first_name" placeholder="Owner First Name" class="h-[50px] w-[300px] rounded-md border-[3px] p-2">
                        <div class="input-errors" v-for="(error, index) of v$.onboardingInformation.first_name.$errors" :key="index">
                            <div class="error-msg text-sm text-red-400">{{ error.$message }}</div>
                        </div>
                    </div>

                    <!--Last Name-->
                    <div class="grid col gap-2">
                        <input v-model="v$.onboardingInformation.last_name.$model" :class="{'border-red-400 focus:border-red-400 focus:ring-red-400': v$.onboardingInformation.last_name.$error, 'border-custom-blue focus:border-custom-blue focus:ring-custom-blue': !v$.onboardingInformation.last_name.$error}" type="text" name="last_name" id="last_name" placeholder="Owner Last Name" class="h-[50px] w-[300px] rounded-md border-[3px] p-2">
                        <div class="input-errors" v-for="(error, index) of v$.onboardingInformation.last_name.$errors" :key="index">
                            <div class="error-msg text-sm text-red-400">{{ error.$message }}</div>
                        </div>
                    </div>
                </div>

                <!--Agency Name Information-->
                <div class="grid grid-cols-2 gap-[80px]">
                    <!--Agency Name-->
                    <div class="grid col gap-2">
                        <input v-model="v$.onboardingInformation.agency_name.$model" :class="{'border-red-400 focus:border-red-400 focus:ring-red-400': v$.onboardingInformation.agency_name.$error, 'border-custom-blue focus:border-custom-blue focus:ring-custom-blue': !v$.onboardingInformation.agency_name.$error}" type="text" name="agency_name" id="agency_name" placeholder="Agency Name" class="h-[50px] w-[300px] rounded-md border-[3px] p-2">
                        <div class="input-errors" v-for="(error, index) of v$.onboardingInformation.agency_name.$errors" :key="index">
                            <div class="error-msg text-sm text-red-400">{{ error.$message }}</div>
                        </div>
                    </div>

                    <!--DBA Name-->
                    <div class="grid col gap-2">
                        <input v-model="v$.onboardingInformation.dba_name.$model" :class="{'border-red-400 focus:border-red-400 focus:ring-red-400': v$.onboardingInformation.dba_name.$error, 'border-custom-blue focus:border-custom-blue focus:ring-custom-blue': !v$.onboardingInformation.dba_name.$error}" type="text" name="dba_name" id="dba_name" placeholder="DBA Name" class="h-[50px] w-[300px] rounded-md border-[3px] p-2">
                        <div class="input-errors" v-for="(error, index) of v$.onboardingInformation.dba_name.$errors" :key="index">
                            <div class="error-msg text-sm text-red-400">{{ error.$message }}</div>
                        </div>
                    </div>
                </div>

                <!--Agency Phone Number and Email-->
                <div class="grid grid-cols-2 gap-[80px]">
                    <!--Phone-->
                    <div class="grid col">
                        <input @change="consoleLog" v-mask="['(###) ###-####']" v-model="v$.onboardingInformation.phone.$model" :class="{'border-red-400 focus:border-red-400 focus:ring-red-400': v$.onboardingInformation.phone.$error, 'border-custom-blue focus:border-custom-blue focus:ring-custom-blue': !v$.onboardingInformation.phone.$error}" type="tel" name="phone" id="phone" placeholder="Phone Number" class="h-[50px] w-[300px] rounded-md border-[3px] p-2">
                        <div class="input-errors" v-for="(error, index) of v$.onboardingInformation.phone.$errors" :key="index">
                            <div class="error-msg text-sm text-red-400">{{ error.$message }}</div>
                        </div>
                    </div>

                    <!--Email-->
                    <div class="grid col">
                        <input v-model="v$.onboardingInformation.email.$model" :class="{'border-red-400 focus:border-red-400 focus:ring-red-400': v$.onboardingInformation.email.$error, 'border-custom-blue focus:border-custom-blue focus:ring-custom-blue': !v$.onboardingInformation.email.$error}" type="email" name="email" id="email" placeholder="Email Address" class="h-[50px] w-[300px] rounded-md border-[3px] p-2">
                        <div class="input-errors" v-for="(error, index) of v$.onboardingInformation.email.$errors" :key="index">
                            <div class="error-msg text-sm text-red-400">{{ error.$message }}</div>
                        </div>
                    </div>
                </div>

                <!--Line Break-->
                <hr class="h-2">

                <!--Google Autocomplete-->
                <div class="grid w-[680px] mx-auto gap-4">
                    <vue-google-autocomplete
                    ref="addressAutocomplete"
                    id="map"
                    classname="form-control"
                    placeholder="Please type your address"
                    v-on:placechanged="getAddressData"
                    country="us"
                    class="h-[50px] rounded-md border-[3px] border-custom-blue p-2"
                    >
                    </vue-google-autocomplete>
                </div>

                <!--Agency Address-->
                <div v-if="onboardingInformation.address_1 != ''" class="grid grid-cols-2 gap-[80px]">     
                    <!--Address 1-->
                    <div class="grid col">
                        <input v-model="v$.onboardingInformation.address_1.$model" disabled type="text" name="address_1" id="address_1" placeholder="Address 1" class="h-[50px] w-[300px] rounded-md border-[3px] border-custom-blue p-2 opacity-40">
                    </div>

                    <!--Address 2-->
                    <div class="grid col">
                        <input v-model="onboardingInformation.address_2" type="text" name="address_2" id="address_2" placeholder="Address 2" class="h-[50px] w-[300px] rounded-md border-[3px] border-red-400 p-2">
                    </div>
                </div>

                <!--City State Zip-->
                <div v-if="onboardingInformation.address_1 != ''" class="grid grid-cols-3 gap-[40px]">   
                    <!--City-->
                    <div class="grid col">
                        <input v-model="onboardingInformation.city" disabled type="text" name="city" id="city" placeholder="City" class="h-[50px] w-[200px] rounded-md border-[3px] border-custom-blue p-2 opacity-40">
                    </div>

                    <!--State-->
                    <div class="grid col">
                        <select v-model="onboardingInformation.state" disabled name="state" id="state" size="1" class="h-[50px] w-[200px] rounded-md border-[3px] border-custom-blue p-2 opacity-40">
                            <option value="" disabled selected>State</option>
                            <option value="AL">Alabama</option>
                            <option value="AK">Alaska</option>
                            <option value="AZ">Arizona</option>
                            <option value="AR">Arkansas</option>
                            <option value="CA">California</option>
                            <option value="CO">Colorado</option>
                            <option value="CT">Connecticut</option>
                            <option value="DE">Delaware</option>
                            <option value="DC">Dist of Columbia</option>
                            <option value="FL">Florida</option>
                            <option value="GA">Georgia</option>
                            <option value="HI">Hawaii</option>
                            <option value="ID">Idaho</option>
                            <option value="IL">Illinois</option>
                            <option value="IN">Indiana</option>
                            <option value="IA">Iowa</option>
                            <option value="KS">Kansas</option>
                            <option value="KY">Kentucky</option>
                            <option value="LA">Louisiana</option>
                            <option value="ME">Maine</option>
                            <option value="MD">Maryland</option>
                            <option value="MA">Massachusetts</option>
                            <option value="MI">Michigan</option>
                            <option value="MN">Minnesota</option>
                            <option value="MS">Mississippi</option>
                            <option value="MO">Missouri</option>
                            <option value="MT">Montana</option>
                            <option value="NE">Nebraska</option>
                            <option value="NV">Nevada</option>
                            <option value="NH">New Hampshire</option>
                            <option value="NJ">New Jersey</option>
                            <option value="NM">New Mexico</option>
                            <option value="NY">New York</option>
                            <option value="NC">North Carolina</option>
                            <option value="ND">North Dakota</option>
                            <option value="OH">Ohio</option>
                            <option value="OK">Oklahoma</option>
                            <option value="OR">Oregon</option>
                            <option value="PA">Pennsylvania</option>
                            <option value="RI">Rhode Island</option>
                            <option value="SC">South Carolina</option>
                            <option value="SD">South Dakota</option>
                            <option value="TN">Tennessee</option>
                            <option value="TX">Texas</option>
                            <option value="UT">Utah</option>
                            <option value="VT">Vermont</option>
                            <option value="VA">Virginia</option>
                            <option value="WA">Washington</option>
                            <option value="WV">West Virginia</option>
                            <option value="WI">Wisconsin</option>
                            <option value="WY">Wyoming</option>
                        </select>
                    </div>

                    <!--Zip-->
                    <div class="grid col">
                        <input v-model="onboardingInformation.zip" disabled type="number" name="zip" id="zip" placeholder="Zip" class="h-[50px] w-[200px] rounded-md border-[3px] border-custom-blue p-2 opacity-40">
                    </div>
                </div>
            </div>
        </div>

        <!--Appointment Information-->
        <div v-else-if="currentStep === 1" class="grid py-6 w-fit mx-auto justify-items-center">
            <!--No Carriers Selected Disclaimer-->
            <div :class="carrierPopup ? '' : 'hidden'" class="grid z-10 fixed w-[400px] h-[200px] rounded-xl bg-white border-2 border-custom-gray border-opacity-40 shadow-newdrop">
                <p class="text-center text-md text-custom-gray my-auto">We see that you have <span class="text-red-400">not</span> entered any NFIP or Private Flood carrier. Are you sure you want to continue?</p>
                <div class="flex gap-6 w-fit mx-auto">
                    <button @click="carrierDisYes" class="h-fit text-md border-2 rounded border-custom-gray border-opacity-40 px-4">Yes</button>
                    <button @click="carrierDisNo" class="h-fit text-md border-2 text-white rounded border-red-400 bg-red-400 px-4">No</button>
                </div>
            </div>

            <h2 class="text-[25px] font-semibold text-custom-gray text-center">Carrier and State Information</h2>
            <h3 class="text-[15px] text-custom-gray text-center">This will allow you to utilize your existing codes within <br> the comparative rater</h3>

            <div class="grid w-[680px] mx-auto mt-8 gap-4 h-fit">
                <div class="grid grid-cols-2 gap-[80px]">
                    <!--Carrier Select-->
                    <div class="grid col gap-2 h-fit">
                        <div class="grid">
                            <h2 class="text-custom-gray font-medium text-lg">Flood Insurance Carriers</h2>
                            <h3 class="text-custom-gray text-sm">Both NFIP and Private</h3>
                        </div>
                        
                        <div v-for="(carrier, index) in carriers" :key="index" class="flex gap-4 w-fit">
                            <input v-model="carrier.name" type="text" placeholder="Enter carrier name" class="h-[50px] w-[250px] rounded-md border-custom-blue focus:border-custom-blue focus:ring-custom-blue border-[3px] p-2">
                            <img @click="deleteCarrier(index)" :class="this.carriers.length == 1? 'hidden' : ''" src="../assets/trash.svg" alt="Trash Can" class="h-[25px] my-auto hover:cursor-pointer">
                        </div>
                        
                        <button @click="addCarrier" class="text-sm text-white uppercase bg-custom-blue w-fit py-2 px-6 rounded-xl">Add Carrier</button>
                    </div>

                    <!--Additional States-->
                    <div class="grid col gap-2 h-fit">
                        <div class="grid">
                            <h2 class="text-custom-gray font-medium text-lg">Appointed States</h2>
                            <div class="flex flow-root w-[250px]">
                                <p @click="addAllStates" class="text-sm text-custom-blue hover:cursor-pointer float-left">Add all states</p>
                                <p @click="removeAllStates" class="text-sm text-custom-blue hover:cursor-pointer float-right">Remove all states</p>
                            </div>
                        </div>

                        <div v-for="(state, index) in appointedStates" :key="index" class="flex gap-4 w-fit">
                            <select v-model="state.name" size="1" class="h-[50px] w-[250px] rounded-md border-[3px] border-custom-blue p-2">
                                <option value="" disabled selected>State</option>
                                <option value="AL">Alabama</option>
                                <option value="AK">Alaska</option>
                                <option value="AZ">Arizona</option>
                                <option value="AR">Arkansas</option>
                                <option value="CA">California</option>
                                <option value="CO">Colorado</option>
                                <option value="CT">Connecticut</option>
                                <option value="DE">Delaware</option>
                                <option value="DC">Dist of Columbia</option>
                                <option value="FL">Florida</option>
                                <option value="GA">Georgia</option>
                                <option value="HI">Hawaii</option>
                                <option value="ID">Idaho</option>
                                <option value="IL">Illinois</option>
                                <option value="IN">Indiana</option>
                                <option value="IA">Iowa</option>
                                <option value="KS">Kansas</option>
                                <option value="KY">Kentucky</option>
                                <option value="LA">Louisiana</option>
                                <option value="ME">Maine</option>
                                <option value="MD">Maryland</option>
                                <option value="MA">Massachusetts</option>
                                <option value="MI">Michigan</option>
                                <option value="MN">Minnesota</option>
                                <option value="MS">Mississippi</option>
                                <option value="MO">Missouri</option>
                                <option value="MT">Montana</option>
                                <option value="NE">Nebraska</option>
                                <option value="NV">Nevada</option>
                                <option value="NH">New Hampshire</option>
                                <option value="NJ">New Jersey</option>
                                <option value="NM">New Mexico</option>
                                <option value="NY">New York</option>
                                <option value="NC">North Carolina</option>
                                <option value="ND">North Dakota</option>
                                <option value="OH">Ohio</option>
                                <option value="OK">Oklahoma</option>
                                <option value="OR">Oregon</option>
                                <option value="PA">Pennsylvania</option>
                                <option value="RI">Rhode Island</option>
                                <option value="SC">South Carolina</option>
                                <option value="SD">South Dakota</option>
                                <option value="TN">Tennessee</option>
                                <option value="TX">Texas</option>
                                <option value="UT">Utah</option>
                                <option value="VT">Vermont</option>
                                <option value="VA">Virginia</option>
                                <option value="WA">Washington</option>
                                <option value="WV">West Virginia</option>
                                <option value="WI">Wisconsin</option>
                                <option value="WY">Wyoming</option>
                            </select>
                            <img @click="deleteState(index)" :class="this.appointedStates.length == 1? 'hidden' : ''" src="../assets/trash.svg" alt="Trash Can" class="h-[25px] my-auto hover:cursor-pointer">
                        </div>

                        <button @click="addState" class="text-sm text-white uppercase bg-custom-blue w-fit py-2 px-6 rounded-xl">Add State</button>
                    </div>
                </div>
            </div>
        </div>

        <!--Entity and Licensing Information-->
        <div v-else-if="currentStep === 2" class="grid py-6 w-fit mx-auto justify-items-center">
            <h2 class="text-[25px] font-semibold text-custom-gray text-center">Entity and Licensing Information</h2>

            <div class="grid w-[680px] mx-auto mt-8 gap-4">
                <div v-if="!onboardingInformation.wright" class="grid gap-4">
                    <!--Agent License and NPN -->
                    <div class="grid grid-cols-2 gap-[80px]">
                        <!--Agent License-->
                        <div class="grid col gap-2">
                            <input v-model="v$.onboardingInformation.agent_license.$model" :class="{'border-red-400 focus:border-red-400 focus:ring-red-400': v$.onboardingInformation.agent_license.$error, 'border-custom-blue focus:border-custom-blue focus:ring-custom-blue': !v$.onboardingInformation.agent_license.$error}" type="text" name="agent_license" id="agent_license" placeholder="Agent License" class="h-[50px] w-[300px] rounded-md border-[3px] p-2">
                            <div class="input-errors" v-for="(error, index) of v$.onboardingInformation.agent_license.$errors" :key="index">
                                <div class="error-msg text-sm text-red-400">{{ error.$message }}</div>
                            </div>
                        </div>

                        <!--Agent NPN-->
                        <div class="grid col gap-2">
                            <input v-model="v$.onboardingInformation.agent_npn.$model" v-mask="['#######']" :class="{'border-red-400 focus:border-red-400 focus:ring-red-400': v$.onboardingInformation.agent_npn.$error, 'border-custom-blue focus:border-custom-blue focus:ring-custom-blue': !v$.onboardingInformation.agent_npn.$error}" type="text" name="agent_npn" id="agent_npn" placeholder="Agent NPN" class="h-[50px] w-[300px] rounded-md border-[3px] p-2">
                            <div class="input-errors" v-for="(error, index) of v$.onboardingInformation.agent_npn.$errors" :key="index">
                                <div class="error-msg text-sm text-red-400">{{ error.$message }}</div>
                            </div>
                        </div>
                    </div>

                    <!--Agent License Eff and Exp-->
                    <div class="grid grid-cols-2 gap-[80px]">
                        <!--Eff Data-->
                        <div class="grid col">
                            <input v-model="v$.onboardingInformation.agent_license_eff.$model" required type="text" name="agent_license_eff" id="agent_license_eff" placeholder="Agent License Issue Date" class="h-[50px] w-[300px] rounded-md border-[3px] border-custom-blue p-2" onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'}">
                        </div>

                        <!--Exp Date-->
                        <div class="grid col">
                            <input v-model="v$.onboardingInformation.agent_license_exp.$model" type="text" name="agent_license_exp" id="agent_license_exp" placeholder="Agent License Exp Date" class="h-[50px] w-[300px] rounded-md border-[3px] border-custom-blue p-2" onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'}">
                        </div>
                    </div>

                    <hr class="h-2">
                </div>
                <!--Agency License and Tax ID-->
                <div class="grid grid-cols-2 gap-[80px]">
                    <!--Agency License-->
                    <div class="grid col gap-2">
                        <input v-model="v$.onboardingInformation.agency_license.$model" :class="{'border-red-400 focus:border-red-400 focus:ring-red-400': v$.onboardingInformation.agency_license.$error, 'border-custom-blue focus:border-custom-blue focus:ring-custom-blue': !v$.onboardingInformation.agency_license.$error}" type="text" name="agency_license" id="agency_license" placeholder="Agency License" class="h-[50px] w-[300px] rounded-md border-[3px] p-2">
                        <div class="input-errors" v-for="(error, index) of v$.onboardingInformation.agency_license.$errors" :key="index">
                            <div class="error-msg text-sm text-red-400">{{ error.$message }}</div>
                        </div>
                    </div>

                    <!--Tax ID-->
                    <div class="grid col gap-2">
                        <input v-model="v$.onboardingInformation.agency_tax_id.$model" v-mask="['##-#######']" :class="{'border-red-400 focus:border-red-400 focus:ring-red-400': v$.onboardingInformation.agency_tax_id.$error, 'border-custom-blue focus:border-custom-blue focus:ring-custom-blue': !v$.onboardingInformation.agency_tax_id.$error}" type="text" name="agency_tax_id" id="agency_tax_id" placeholder="Tax ID" class="h-[50px] w-[300px] rounded-md border-[3px] p-2">
                        <div class="input-errors" v-for="(error, index) of v$.onboardingInformation.agency_tax_id.$errors" :key="index">
                            <div class="error-msg text-sm text-red-400">{{ error.$message }}</div>
                        </div>
                    </div>
                </div>

                <!--Agency Type and Logo Upload-->
                <div class="grid grid-cols-2 gap-[80px]">
                    <!--Agency Type-->
                    <div class="grid col gap-2">
                        <select v-model="v$.onboardingInformation.agency_type.$model" name="agency_type" id="agency_type" size="0" class="h-[50px] w-[300px] rounded-md border-[3px] border-custom-blue p-2">
                            <option value="" selected>Select Entity Type</option>
                            <option value="Sole">Individual/Sole Proprietor/Single Member LLC</option>
                            <option value="LLC-C">LLC - C Corporation</option>
                            <option value="LLC-S">LLC - S Corporation</option>
                            <option value="LLC-P">LLC - Partnership</option>
                            <option value="S-Corp">C Corporation</option>
                            <option value="C-Corp">S Corporation</option>
                            <option value="Partner">Partnership</option>
                            <option value="Trust">Trust/Estate</option>
                        </select>
                        <div class="input-errors" v-for="(error, index) of v$.onboardingInformation.agency_type.$errors" :key="index">
                            <div class="error-msg text-sm text-red-400">{{ error.$message }}</div>
                        </div>
                    </div>

                    <!--Agency Logo-->
                    <div class="grid col gap-2">
                        <input @change="uploadFile" ref="logoFileUploader" type="file" accept=".png, .jpg, .jpeg, .svg" name="agency_logo" id="agency_logo" class="hidden">
                        <div v-if="!onboardingInformation.agency_logo" v-on:click="$refs.logoFileUploader.click()" class="flex h-[50px] w-[300px] border-[3px] border-custom-blue border-opacity-40 gap-6 bg-custom-blue bg-opacity-40 w-fit py-2 px-6 rounded-md hover:cursor-pointer">
                            <img src="../assets/white-cloud-upload.svg" alt="Cloud Upload Icon" id="upload-icon" class="h-[25px]">
                            <div class="flex my-auto h-fit gap-2">
                                <p class="text-md text-white font-medium">Upload Company Logo</p>
                            </div>
                        </div>
                        <div v-else v-on:click="$refs.logoFileUploader.click()" class="flex h-[50px] w-[300px] border-[3px] border-green-400 gap-6 bg-green-400 w-fit py-2 px-6 rounded-md hover:cursor-pointer">
                            <img src="../assets/white-cloud-upload.svg" alt="Cloud Upload Icon" id="upload-icon" class="h-[25px]">
                            <div class="flex my-auto h-fit gap-2">
                                <p class="text-m text-white font-medium">Upload Company Logo</p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        <!--EO Information-->
        <div v-else-if="currentStep === 3" class="grid py-6 w-fit mx-auto justify-items-center">
            <h2 class="text-[25px] font-semibold text-custom-gray text-center">E&O Information</h2>

            <div class="grid w-[680px] mx-auto mt-8 gap-4">
                <!--E&O Upload and Exp Date-->
                <div class="grid grid-cols-2 gap-[80px]">
                    <!--E&O Upload-->
                    <div class="grid col gap-2">
                        <input @change="uploadFile" ref="eoFileUploader" type="file" accept=".pdf" name="eo" id="eo" class="hidden">
                        <div v-if="!onboardingInformation.eo" v-on:click="$refs.eoFileUploader.click()" class="flex h-[50px] w-[300px] border-[3px] border-custom-blue border-opacity-40 gap-6 bg-custom-blue bg-opacity-40 w-fit py-2 px-6 rounded-md hover:cursor-pointer">
                            <img src="../assets/white-cloud-upload.svg" alt="Cloud Upload Icon" id="upload-icon" class="h-[25px]">
                            <div class="flex my-auto h-fit gap-2">
                                <p class="text-md text-white font-medium">Upload E&O</p>
                            </div>
                        </div>
                        <div v-else v-on:click="$refs.eoFileUploader.click()" class="flex h-[50px] w-[300px] border-[3px] border-green-400 gap-6 bg-green-400 w-fit py-2 px-6 rounded-md hover:cursor-pointer">
                            <img src="../assets/white-cloud-upload.svg" alt="Cloud Upload Icon" id="upload-icon" class="h-[25px]">
                            <div class="flex my-auto h-fit gap-2">
                                <p class="text-m text-white font-medium">Upload E&O</p>
                            </div>
                        </div>
                    </div>

                    <!--E&O Exp-->
                    <div class="grid col">
                        <input v-model="v$.onboardingInformation.eo_exp.$model" required type="text" name="eo_exp" id="eo_exp" placeholder="E&O Exp Date" class="h-[50px] w-[300px] rounded-md border-[3px] border-custom-blue p-2" onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'}">
                    </div>
                </div>

                <div v-if="!this.onboardingInformation.neptune" class="grid gap-4">
                    <!--E&O Policy Number and Limit-->
                    <div class="grid grid-cols-2 gap-[80px]">
                        <!--E&O Policy Number-->
                        <div class="grid col gap-2">
                            <input v-model="v$.onboardingInformation.eo_policy.$model" :class="{'border-red-400 focus:border-red-400 focus:ring-red-400': v$.onboardingInformation.eo_policy.$error, 'border-custom-blue focus:border-custom-blue focus:ring-custom-blue': !v$.onboardingInformation.eo_policy.$error}" type="text" name="eo_policy" id="eo_policy" placeholder="E&O Policy Number" class="h-[50px] w-[300px] rounded-md border-[3px] p-2">
                            <div class="input-errors" v-for="(error, index) of v$.onboardingInformation.eo_policy.$errors" :key="index">
                                <div class="error-msg text-sm text-red-400">{{ error.$message }}</div>
                            </div>
                        </div>

                        <!--E&O Limit-->
                        <div class="grid col gap-2">
                            <input v-model="v$.onboardingInformation.eo_limit.$model" v-mask="['$#########']" :class="{'border-red-400 focus:border-red-400 focus:ring-red-400': v$.onboardingInformation.eo_limit.$error, 'border-custom-blue focus:border-custom-blue focus:ring-custom-blue': !v$.onboardingInformation.eo_limit.$error}" type="text" name="eo_limit" id="eo_limit" placeholder="E&O Limit" class="h-[50px] w-[300px] rounded-md border-[3px] p-2">
                            <div class="input-errors" v-for="(error, index) of v$.onboardingInformation.eo_limit.$errors" :key="index">
                                <div class="error-msg text-sm text-red-400">{{ error.$message }}</div>
                            </div>
                        </div>
                    </div>

                    <!--E&O Insurer-->
                    <div class="grid col gap-2">
                        <input v-model="v$.onboardingInformation.eo_insurer.$model" :class="{'border-red-400 focus:border-red-400 focus:ring-red-400': v$.onboardingInformation.eo_insurer.$error, 'border-custom-blue focus:border-custom-blue focus:ring-custom-blue': !v$.onboardingInformation.eo_insurer.$error}" type="text" name="eo_insurer" id="eo_insurer" placeholder="E&O Insurer" class="h-[50px] w-[300px] rounded-md border-[3px] p-2">
                        <div class="input-errors" v-for="(error, index) of v$.onboardingInformation.eo_insurer.$errors" :key="index">
                            <div class="error-msg text-sm text-red-400">{{ error.$message }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Agreement-->
        <div v-else-if="currentStep === 4" class="grid py-6 w-fit mx-auto justify-items-center">
            <h2 class="text-[25px] font-semibold text-custom-gray text-center">Final Step</h2>
            <h3 class="text-[15px] text-custom-gray text-center">Congratulations! Sign your agreement and you are done! </h3>
            
            <div id="submitLoading" class="w-full ml-[700px] absolute z-10 mt-96 hidden">
                <loading />
            </div>

            <div v-if="!this.onboardingInformation.embed_id" class="mt-16">
                <loading />
            </div>

            <div v-else class="mt-4">
                <div>
                    <iframe :src="'https://app.pandadoc.com/s/' + onboardingInformation.embed_id" width="640" height="800"></iframe>
                </div>   
            </div>
        </div>

        <!--Buttons-->
        <div class="grid gap-6 justify-items-center w-fit mx-auto">
            <!--Next Button-->
            <button v-on:click="next()" v-if="currentStep < steps.length - 1" :disabled="nextDisabled" class="w-[680px] bg-custom-blue p-2 text-white font-semibold rounded-md uppercase disabled:opacity-30">Next</button>
            <!--Submit Button-->
            <button v-on:click="submit()" v-else :disabled="submitDisabled" class="w-[680px] bg-custom-blue p-2 text-white font-semibold rounded-md uppercase disabled:opacity-30">Submit</button>
            <!--Back Button-->
            <button v-on:click="back()" v-if="currentStep != 0" :disabled="backDisabled" class="w-[340px] bg-custom-gray p-2 text-white font-semibold rounded-md uppercase disabled:opacity-30">Back</button>
        </div>
    </div>

    <div v-else class="grid gap-6 mx-auto w-fit mt-24 rounded-xl py-8 px-8 shadow-newdrop bg-white">
        <!--Thank You Page-->
        <h2 class="text-center text-2xl text-custom-gray opacity-75 font-bold">Thank You for Signing Up with RocketMGA</h2>
        <h2 class="text-center text-2xl text-custom-blue font-bold">We are processing you appointment and will be in touch shortly.</h2>
        <p class="text-center text-2xl text-custom-gray">For assistance please contact <span class="text-custom-blue"><a href="mailto:onboardin@rocketmga.com">onboarding@rocketmga.com</a></span></p>
    </div>
</template>

<script>
import { useVuelidate } from '@vuelidate/core'
import { required, email, minLength, maxLength, helpers} from '@vuelidate/validators'
import {mask} from 'vue-the-mask'
import VueGoogleAutocomplete from 'vue-google-autocomplete'
import VueNumeric from 'vue-numeric'
import loading from './loading.vue'
import emailjs from '@emailjs/browser';
import axios from 'axios'

export default {
    name: "Form",
    setup () {
        return {
            v$: useVuelidate()
        }
    },
    data() {
        return{
            currentStep: 0,
            steps: [
                'agencyInfo',
                'apppointmentInfo',
                'entityLicensingInfo',
                'eoInfo',
                'agreement'
            ],
            nextDisabled: false,
            backDisabled: false,
            submitDisabled: false,
            carrierPopup: false,
            carriers: [{name: ""}],
            appointedStates: [{name: ""}],
            apiData: {
                //PandaDoc API
                apiKey: '8135da5570abd90097a2bcc0dbbce76d1decd484',
                templateID: 'PvecfYu2RyWk2fcVVCmQg7',
                //Email JS
                serviceID: 'service_nf9yozb',
                publicKey: 'h29zXRTKkaswfKPkp',
                dualTemplate: 'template_n43poh8',
                palomarTemplate: 'template_lsue7c3',
                maxTemplate: 'template_ajztr2i',
                onboardingConfirmation: 'template_ymmtc35'
            },
            onboardingInformation: {
                rocketMGA_id: '',
                first_name: '',
                last_name: '',
                agency_name: '',
                dba_name: '',
                phone: '',
                email: '',
                address: '',
                address_1: '',
                address_2: '',
                city: '',
                state: '',
                zip: '',
                aon: false, 
                beyond: false, 
                dual: false, 
                flow: false, 
                neptune: false, 
                palomar: false, 
                sterling: false, 
                wright: false,
                agent_license: '',
                agent_npn: '',
                agent_license_eff: '',
                agent_license_exp: '',
                agency_license: '',
                agency_type: '',
                agency_tax_id: '',
                agency_logo: '',
                eo: '',
                eo_exp: '',
                eo_policy: '',
                eo_limit: '',
                eo_insurer: '',
                document_id: '',
                embed_id: '',
                stage: ''
            },
            submitted: false
        }
    },
    props: {
        userID: String
    },
    created: async function() {
        await axios.get('/api/user/' + this.userID)
        .then(response => {
            //Update from database info
            if(response.data.rocketMGA_id != null){this.onboardingInformation.rocketMGA_id = response.data.rocketMGA_id}
            if(response.data.first_name != null){this.onboardingInformation.first_name = response.data.first_name}
            if(response.data.last_name != null){this.onboardingInformation.last_name = response.data.last_name}
            if(response.data.agency_name != null){this.onboardingInformation.agency_name = response.data.agency_name}
            if(response.data.dba_name != null){this.onboardingInformation.dba_name = response.data.dba_name}
            if(response.data.phone != null){this.onboardingInformation.phone = response.data.phone}
            if(response.data.email != null){this.onboardingInformation.email = response.data.email}
            if(response.data.address != null){this.onboardingInformation.address = response.data.address}
            if(response.data.address_1 != null){this.onboardingInformation.address_1 = response.data.address_1}
            if(response.data.address_2 != null){this.onboardingInformation.address_2 = response.data.address_2}
            if(response.data.city != null){this.onboardingInformation.city = response.data.city}
            if(response.data.state != null){this.onboardingInformation.state = response.data.state}
            if(response.data.zip != null){this.onboardingInformation.zip = response.data.zip}
            if(response.data.agent_license != null){this.onboardingInformation.agent_license = response.data.agent_license}
            if(response.data.agent_npn != null){this.onboardingInformation.agent_npn = response.data.agent_npn}
            if(response.data.agent_license_eff != null){this.onboardingInformation.agent_license_eff = response.data.agent_license_eff}
            if(response.data.agent_license_exp != null){this.onboardingInformation.agent_license_exp = response.data.agent_license_exp}
            if(response.data.agency_license != null){this.onboardingInformation.agency_license = response.data.agency_license}
            if(response.data.agency_type != null){this.onboardingInformation.agency_type = response.data.agency_type}
            if(response.data.agency_tax_id != null){this.onboardingInformation.agency_tax_id = response.data.agency_tax_id}
            if(response.data.agency_logo != null){this.onboardingInformation.agency_logo = response.data.agency_logo}
            if(response.data.eo != null){this.onboardingInformation.eo = response.data.eo}
            if(response.data.eo_exp != null){this.onboardingInformation.eo_exp = response.data.eo_exp}
            if(response.data.eo_policy != null){this.onboardingInformation.eo_policy = response.data.eo_policy}
            if(response.data.eo_limit != null){this.onboardingInformation.eo_limit = response.data.eo_limit}
            if(response.data.eo_insurer != null){this.onboardingInformation.eo_insurer = response.data.eo_insurer}
            if(response.data.document_id != null){this.onboardingInformation.document_id = response.data.document_id}
            if(response.data.embed_id != null){this.onboardingInformation.embed_id = response.data.embed_id}

            //Update Carrier info
            this.onboardingInformation.aon = response.data.aon
            this.onboardingInformation.beyond = response.data.beyond
            this.onboardingInformation.dual = response.data.dual
            this.onboardingInformation.flow = response.data.flow
            this.onboardingInformation.neptune = response.data.neptune
            this.onboardingInformation.palomar = response.data.palomar
            this.onboardingInformation.sterling = response.data.sterling
            this.onboardingInformation.wright = response.data.wright

            //Update Stage
            this.onboardingInformation.stage = response.data.stage

            //Update submitted
            this.submitted = response.data.submitted

            //Carriers
            if (response.data.carriers != null){
                let carrierArr = response.data.carriers.split(",")
                this.carriers = []
                carrierArr.forEach(carrier => {
                    this.carriers.push({name: carrier})
                })
            }

            //Additional States
            if (response.data.additional_states != null){
                let statesArr = response.data.additional_states.split(",")
                this.appointedStates = []
                statesArr.forEach(state => {
                    this.appointedStates.push({name: state})
                })
            }
        })
    },
    mounted() {
        this.$refs.addressAutocomplete.focus();
    },
    methods: {
        next(){
            if(this.currentStep === 0){
                if(!this.onboardingInformation.agency_name || this.v$.onboardingInformation.agency_name.$error || !this.onboardingInformation.dba_name || this.v$.onboardingInformation.dba_name.$error || !this.onboardingInformation.first_name || this.v$.onboardingInformation.first_name.$error || !this.onboardingInformation.last_name || this.v$.onboardingInformation.last_name.$error || !this.onboardingInformation.phone || this.v$.onboardingInformation.phone.$error || !this.onboardingInformation.email || this.v$.onboardingInformation.email.$error || !this.onboardingInformation.address_1 || this.v$.onboardingInformation.address_1.$error){
                    alert('Please make sure all fields are complete and valid.')
                    return
                } else {
                    //Push home state to appointed states
                    if(this.appointedStates[0].name === ""){
                        this.appointedStates =  []
                        this.appointedStates.push({name: this.onboardingInformation.state})
                    }

                    //Update Address var
                    this.onboardingInformation.address= `${this.onboardingInformation.address_1} ${this.onboardingInformation.address_2}, ${this.onboardingInformation.city}, ${this.onboardingInformation.state} ${this.onboardingInformation.zip}`

                    //Upload Agency Info
                    axios.put('/api/user/update/' + this.userID, {
                        user: {
                            "agent_name": `${this.onboardingInformation.first_name} ${this.onboardingInformation.last_name}`,
                            "first_name": this.onboardingInformation.first_name,
                            "last_name": this.onboardingInformation.last_name,
                            "agency_name": this.onboardingInformation.agency_name,
                            "dba_name": this.onboardingInformation.dba_name,
                            "phone": this.onboardingInformation.phone,
                            "email": this.onboardingInformation.email,
                            "address": this.onboardingInformation.address,
                            "address_1": this.onboardingInformation.address_1,
                            "address_2": this.onboardingInformation.address_2,
                            "city": this.onboardingInformation.city,
                            "state": this.onboardingInformation.state,
                            "zip": this.onboardingInformation.zip
                        }
                    })

                    //Update Stage
                    if(this.onboardingInformation.stage == "portal_agency_info"){
                        axios.put('/api/user/update/' + this.userID, {
                            "stage": "portal_appointment_info"
                        })

                        this.onboardingInformation.stage = "portal_appointment_info"
                    }


                    this.currentStep += 1;
                    return
                }
            }
            else if(this.currentStep === 1){
                if(this.carriers === [] || this.carriers[0].name === ''){
                    this.nextDisabled = true
                    //Show Popup
                    this.carrierPopup = true
                }
                else {
                    //Update if they have our carriers
                    this.carriers.forEach(carrier => {
                        if(carrier.name.toLowerCase().includes('aon')){this.onboardingInformation.aon = true}
                        else if (carrier.name.toLowerCase().includes('beyond')){this.onboardingInformation.beyond = true}else if (carrier.name.toLowerCase().includes('national general')){this.onboardingInformation.beyond = true}
                        else if (carrier.name.toLowerCase().includes('dual')){this.onboardingInformation.dual = true}
                        else if (carrier.name.toLowerCase().includes('flow')){this.onboardingInformation.flow = true}
                        else if (carrier.name.toLowerCase().includes('neptune')){this.onboardingInformation.neptune = true}
                        else if (carrier.name.toLowerCase().includes('palomar')){this.onboardingInformation.palomar = true}
                        else if (carrier.name.toLowerCase().includes('sterling')){this.onboardingInformation.sterling = true}
                        else if (carrier.name.toLowerCase().includes('wright')){this.onboardingInformation.wright = true}
                    })

                    //Set Carriers to false
                    let checkCarriers = ""
                    this.carriers.forEach(carrier => {
                        if (checkCarriers === ''){
                            checkCarriers = carrier.name.toLowerCase()
                        } else {
                            checkCarriers = `${checkCarriers},${carrier.name.toLowerCase()}`
                        }
                    })
                    
                    if(!checkCarriers.includes('aon')){this.onboardingInformation.aon = false}
                    else if(!checkCarriers.includes('beyond')){this.onboardingInformation.beyond = false}
                    else if(!checkCarriers.includes('dual')){this.onboardingInformation.dual = false}
                    else if(!checkCarriers.includes('flow')){this.onboardingInformation.flow = false}
                    else if(!checkCarriers.includes('neptune')){this.onboardingInformation.neptune = false}
                    else if(!checkCarriers.includes('palomar')){this.onboardingInformation.palomar = false}
                    else if(!checkCarriers.includes('sterling')){this.onboardingInformation.sterling = false}
                    else if(!checkCarriers.includes('wright')){this.onboardingInformation.wright = false}

                    //Update Database with our carrier information
                    axios.put('/api/user/update/' + this.userID, {
                        "user": {
                            "aon": this.onboardingInformation.aon,
                            "beyond": this.onboardingInformation.beyond,
                            "dual": this.onboardingInformation.dual,
                            "flow": this.onboardingInformation.flow,
                            "neptune": this.onboardingInformation.neptune,
                            "palomar": this.onboardingInformation.palomar,
                            "sterling": this.onboardingInformation.sterling,
                            "wright": this.onboardingInformation.wright
                        }
                    })

                    //Update Stage
                    if(this.onboardingInformation.stage == "portal_appointment_info"){
                        axios.put('/api/user/update/' + this.userID, {
                            "stage": "portal_entity_info"
                        })

                        this.onboardingInformation.stage = "portal_entity_info"
                    }

                    //Create and Append to Carrier String
                    let carrierStr = ""

                    this.carriers.forEach(carrier => {
                        if(!carrierStr){
                            carrierStr = carrier.name.toLowerCase()
                        } else {
                            carrierStr = `${carrierStr},${carrier.name.toLowerCase()}`
                        }
                    })

                    //Add Carriers to Database
                    axios.put('/api/user/update/' + this.userID, {
                        "user": {
                            "carriers": carrierStr
                        }
                    })

                    //Create and Append to Additional States String
                    let statesStr = ""

                    this.appointedStates.forEach(state => {
                        if(!statesStr){
                            statesStr = state.name
                        } else {
                            statesStr = `${statesStr},${state.name}`
                        }
                    })

                    //Add State to Database
                    axios.put('/api/user/update/' + this.userID, {
                        "user": {
                            "additional_states": statesStr
                        }
                    })

                    this.currentStep += 1;
                    return
                }
            }
            else if(this.currentStep === 2){
                if(!this.onboardingInformation.agency_license || this.v$.onboardingInformation.agency_license.$error || !this.onboardingInformation.agency_tax_id || this.v$.onboardingInformation.agency_tax_id.$error || !this.onboardingInformation.agency_type || this.v$.onboardingInformation.agency_type.$error || !this.onboardingInformation.agency_logo){
                    alert('Please make sure all fields are complete and vaild.')
                    return
                } else {
                    //Validate Wright Values if they dont have wright
                    if(!this.onboardingInformation.wright){
                        if(!this.onboardingInformation.agent_license || this.v$.onboardingInformation.agent_license.$error || !this.onboardingInformation.agent_npn || this.v$.onboardingInformation.agent_npn.$error || !this.onboardingInformation.agent_license_eff || this.v$.onboardingInformation.agent_license_eff.$error || !this.onboardingInformation.agent_license_exp || this.v$.onboardingInformation.agent_license_exp.$error){
                            alert('Please make sure all fields are complete and valid.')
                            return
                        }
                    }

                    //Upload Agency Logo
                    if(typeof this.onboardingInformation.agency_logo === 'object'){
                        const logoConfig = {
                            headers: {'content-type': 'multipart/form-data'}
                        }
                        let logoData = new FormData();
                        logoData.append('file', this.onboardingInformation.agency_logo);
                        logoData.append('userID', this.userID);
                        logoData.append('type', "Logo");
                        axios.post('/api/upload', logoData, logoConfig)
                        .then(response => {
                            this.onboardingInformation.agency_logo = response.data['id']
                            //Upload agency logo id to database
                            axios.put('/api/user/update/' + this.userID, {
                                "user": {
                                    "agency_logo": this.onboardingInformation.agency_logo
                                }
                            })
                        })
                        return
                    }

                    //Upload Agency/Entity information to Database
                    axios.put('/api/user/update/' + this.userID, {
                        "user": {
                            "agency_license": this.onboardingInformation.agency_license,
                            "agency_tax_id": this.onboardingInformation.agency_tax_id,
                            "agency_type": this.onboardingInformation.agency_type
                        }
                    })

                    //Update Stage
                    if(this.onboardingInformation.stage == "portal_entity_info"){
                        axios.put('/api/user/update/' + this.userID, {
                            "stage": "portal_eo_info"
                        })

                        this.onboardingInformation.stage = "portal_eo_info"
                    }

                    //Upload Agent Information if they do not have Wright
                    if(!this.onboardingInformation.wright){
                        axios.put('/api/user/update/' + this.userID, {
                            "user": {
                                "agent_license": this.onboardingInformation.agent_license,
                                "agent_npn": this.onboardingInformation.agent_npn,
                                "agent_license_eff": this.onboardingInformation.agent_license_eff,
                                "agent_license_exp": this.onboardingInformation.agent_license_exp
                            }
                        })
                    }
                    
                    this.currentStep += 1;
                    return
                }
            }
            else if(this.currentStep === 3){
                if(!this.onboardingInformation.eo || !this.onboardingInformation.eo_exp || this.v$.onboardingInformation.eo_exp.$error){
                    alert("Please make sure all fields are complete and vaild.")
                    return
                } else {
                    //If they do no have Neptune check additional fields
                    if(!this.onboardingInformation.neptune){
                        if(!this.onboardingInformation.eo_policy || this.v$.onboardingInformation.eo_policy.$error || !this.onboardingInformation.eo_limit || this.v$.onboardingInformation.eo_limit.$error || !this.onboardingInformation.eo_insurer || this.v$.onboardingInformation.eo_insurer.$error){
                            alert('Please make sure all fields are complete and valid.')
                            return
                        }
                    }

                    //Upload Agency E&O
                    if(typeof this.onboardingInformation.eo === 'object'){
                        const eoConfig = {
                            headers: {'content-type': 'multipart/form-data'}
                        }
                        let eoData = new FormData();
                        eoData.append('file', this.onboardingInformation.eo);
                        eoData.append('userID', this.userID);
                        eoData.append('type', "E&O");
                        axios.post('/api/upload', eoData, eoConfig)
                        .then(response => {
                            this.onboardingInformation.eo = response.data['id']
                            //Upload E&O id to database
                            axios.put('/api/user/update/' + this.userID, {
                                "user": {
                                    "eo": this.onboardingInformation.eo
                                }
                            })
                        })
                        return
                    }

                    //Upload E&O information to Database
                    axios.put('/api/user/update/' + this.userID, {
                        "user": {
                            "eo_exp": this.onboardingInformation.eo_exp
                        }
                    })

                    //Update Stage
                    if(this.onboardingInformation.stage == "portal_eo_info"){
                        axios.put('/api/user/update/' + this.userID, {
                            "stage": "portal_agreement"
                        })

                        this.onboardingInformation.stage = "portal_agreement"
                    }

                    //Upload E&O information if they do not have Neptune
                    if(!this.onboardingInformation.neptune){
                        axios.put('/api/user/update/' + this.userID, {
                            "user": {
                                "eo_policy": this.onboardingInformation.eo_policy,
                                "eo_limit": this.onboardingInformation.eo_limit.replace('$', ''),
                                "eo_insurer": this.onboardingInformation.eo_insurer
                            }
                        })
                    }

                    //If embed_id already exists go to next step if not start API
                    if (this.onboardingInformation.embed_id != '')  {
                        this.currentStep += 1
                    } else {
                        //Start PandaDoc API   
                        this.createDocument()

                        this.currentStep += 1

                        //Disable Submit and Back Buttons
                        this.submitDisabled = true
                        this.backDisabled = true
                    }

                    return
                }
            }
            
        },
        back(){
            this.currentStep -= 1;
        },
        async submit(){
            //Disable Submit and Back Button
            this.submitDisabled = true;
            this.backDisabled = true;
            //Show Loading Spinner
            document.getElementById("submitLoading").classList.remove("hidden")

            //Variable checking document completed status
            let documentCompleted = false

            //Get Agreement Document Status
            const statusHeaders = {
                headers: {'Authorization': `API-Key ${this.apiData.apiKey}`}
            }

            await axios.get(`https://api.pandadoc.com/public/v1/documents/${this.onboardingInformation.document_id}`, statusHeaders)
            .then(response => {
                if(response.data.status === 'document.completed'){
                    documentCompleted = true
                }
            })

            //If document not completed then alert
            if(!documentCompleted){
                //Hide Loading Spinner
                document.getElementById("submitLoading").classList.add("hidden")
                //Enable Submit and Back Button
                this.submitDisabled = false;
                this.backDisabled = false;
                alert('Agreements not completed, please finalize and try again')
                return
            }

            //Get Zip+4

            //Email Carriers and Max
            //Email to Dual
            emailjs.init(this.apiData.publicKey)
            emailjs.send(this.apiData.serviceID, this.apiData.dualTemplate, {
                agencyName: this.onboardingInformation.agency_name,
                agentName: this.onboardingInformation.first_name + " " + this.onboardingInformation.last_name,
                agentEmail: this.onboardingInformation.email,
                agentPhone: this.onboardingInformation.phone,
                agencyFullAddress: this.onboardingInformation.address
            })

            //Email to Palomar
            emailjs.init(this.apiData.publicKey)
            emailjs.send(this.apiData.serviceID, this.apiData.palomarTemplate, {
                agencyName: this.onboardingInformation.agency_name,
                agentName: this.onboardingInformation.first_name + " " + this.onboardingInformation.last_name,
                agentEmail: this.onboardingInformation.email,
                agentPhone: this.onboardingInformation.phone,
                agencyFullAddress: this.onboardingInformation.address
            })

            //Sub Agent Welcome Email
            emailjs.init(this.apiData.publicKey)
            emailjs.send(this.apiData.serviceID, this.apiData.onboardingConfirmation, {
                agencyName: this.onboardingInformation.agency_name,
                toEmail: this.onboardingInformation.email,
            })

            //Email to Max
            emailjs.init(this.apiData.publicKey)
            emailjs.send(this.apiData.serviceID, this.apiData.maxTemplate, {
                agentName: this.onboardingInformation.first_name + " " + this.onboardingInformation.last_name,
                agencyName: this.onboardingInformation.agency_name,
                agencyDBAname: this.onboardingInformation.dba_name,
                agencyType: this.onboardingInformation.agency_type,
                agentLicense: this.onboardingInformation.agent_license,
                agentLicenseEff: this.onboardingInformation.agent_license_eff,
                agentLicenseExp: this.onboardingInformation.agent_license_exp,
                NPN: this.onboardingInformation.agent_npn,
                rocketMGAid: this.onboardingInformation.rocketMGA_id,
                //neptuneSubAgentCode: ,
                agencyEmail: this.onboardingInformation.email,
                agencyPhone: this.onboardingInformation.phone,
                agencyFullAddress: this.onboardingInformation.address,
                additionalStates: statesStr
            })

            //Add Aon and Wright Data to Google Sheets
            //Get the date of the beginning of the week
            let date = new Date();
            let day = date.getDay() || 7;
            if( day !== 1 )
            date.setHours(-24 * (day));

            let date_last = new Date();
            let day_last = date_last.getDay() || 7;
            if( day_last !== 1 )
            date_last.setHours(-24 * (day_last - 6));
            
            function padTo2Digits(num) {
                return num.toString().padStart(2, '0');
            }

            function formatDate(date) {
                return [
                    padTo2Digits(date.getMonth() + 1),
                    padTo2Digits(date.getDate()),
                    date.getFullYear(),
                ].join('/');
            }

            const weekStart = formatDate(date)
            const weekEnd = formatDate(date_last)
            const week = weekStart + " - " + weekEnd

            //Create Additional States String
            let statesStr = ""

            this.appointedStates.forEach(state => {
                if(!statesStr){
                    statesStr = state.name
                } else {
                    statesStr = `${statesStr},${state.name}`
                }
            })

            //Send Data to Aon Sheet
            await axios.post('https://hooks.zapier.com/hooks/catch/14170682/bjtgf41/', {
                "name": this.onboardingInformation.agency_name,
                "phone": this.onboardingInformation.phone,
                "email": this.onboardingInformation.email,
                "address": this.onboardingInformation.address_1 + " " + this.onboardingInformation.address_2,
                "city": this.onboardingInformation.city,
                "state": this.onboardingInformation.state,
                "zip": this.onboardingInformation.zip,
                "additional_states": statesStr,
                "first_name": this.onboardingInformation.first_name,
                "last_name": this.onboardingInformation.last_name,
                "week": week
            })

            //Send Data to Wright Sheet
            await axios.post('https://hooks.zapier.com/hooks/catch/14170682/bjh4r3i/',  {
                "name": this.onboardingInformation.agency_name,
                "dba_name": this.onboardingInformation.dba_name,
                "phone": this.onboardingInformation.phone,
                "email": this.onboardingInformation.email,
                "agency_type": this.onboardingInformation.agency_type,
                "address1": this.onboardingInformation.address_1,
                "address2": this.onboardingInformation.address_2,
                "city": this.onboardingInformation.city,
                "state": this.onboardingInformation.state,
                "zip": this.onboardingInformation.zip,
                "agent_name": this.onboardingInformation.first_name + " " + this.onboardingInformation.last_name,
                "agent_license": this.onboardingInformation.agent_license,
                "license_eff": this.onboardingInformation.agent_license_eff,
                "license_exp": this.onboardingInformation.agent_license_exp,
                "npn": this.onboardingInformation.agent_npn,
                "week": week
            })


            //Check and Add to Zoho
            await axios.post('https://hooks.zapier.com/hooks/catch/14170682/bjht2i9/', {
                "agency_name": this.onboardingInformation.agency_name,
                "agent_name": this.onboardingInformation.first_name + " " + this.onboardingInformation.last_name,
                "phone": this.onboardingInformation.phone.replace(/[() -]/g, ''),
                "email": this.onboardingInformation.email,
                "adress": this.onboardingInformation.address_1 + " " + this.onboardingInformation.address_2,
                "city": this.onboardingInformation.city,
                "state": this.onboardingInformation.state,
                "zip": this.onboardingInformation.zip,
                "npn": this.onboardingInformation.agent_npn,
                "source": "Onboarding Portal"
            })

            //Update database submitted and stage
            await axios.put('/api/user/update/' + this.userID, {
                "user": {
                    "stage": "Submitted",
                    "submitted": true
                }
            })

            //Create new completed Notification for Backend
            await axios.post('/api/notification/add', {
                "agency": this.onboardingInformation.agency_name,
                "agency_id": this.userID
            })

            //Send Flow and Palomar Credentials to Appointed Agents Table
            await axios.post('/api/appointed/add', {
                "rocketMGA_id": this.onboardingInformation.rocketMGA_id,
                "flow": this.onboardingInformation.email,
                "palomar": this.onboardingInformation.email
            })

            this.submitted = true

        },
        getAddressData: function (addressData, placeResultData, map) {
            this.onboardingInformation.address_1 = `${addressData.street_number} ${addressData.route}`
            this.onboardingInformation.city = addressData.locality
            this.onboardingInformation.state = addressData.administrative_area_level_1
            this.onboardingInformation.zip = addressData.postal_code

            if(addressData.subpremise === undefined){
                this.onboardingInformation.address_2 = ''
            } else {
                this.onboardingInformation.address_2 = addressData.subpremise
            }
        },
        addCarrier() {
            this.carriers.push({name: ""})
        },
        deleteCarrier(index){
            this.carriers.splice(index, 1)
        },
        addState() {
            this.appointedStates.push({name: ""})
        },
        deleteState(index){
            this.appointedStates.splice(index, 1)
        },
        addAllStates(){
            this.appointedStates = []
            this.appointedStates.push({name: this.onboardingInformation.state})

            axios.get('https://worldpopulationreview.com/static/states/name-abbr.json')
            .then(response =>{
                let states = Object.keys(response.data)
                states.forEach(state => {
                    if(response.data[state] != this.onboardingInformation.state){
                        this.appointedStates.push({name: response.data[state]})
                        return
                    } else { return }
                })
            })
        },
        removeAllStates(){
            this.appointedStates = []
            this.appointedStates.push({name: this.onboardingInformation.state})
        },
        carrierDisYes(){
            this.nextDisabled = false
            this.carrierPopup = false
            this.currentStep += 1;
        },
        carrierDisNo(){
            this.nextDisabled = false
            this.carrierPopup = false
        },
        uploadFile (e) {
            const file = e.target.files[0];
            if (!file) {
                return
            }

            if (e.target.name === 'agency_logo'){
                this.onboardingInformation.agency_logo = file
                return
            }

            if (e.target.name === 'eo'){
                this.onboardingInformation.eo = file
                return
            }
        },
        async createDocument(){
            //Todays Date
            let today = new Date().toLocaleDateString()
            //Day and Month
            let ddmm = today.slice(0, 5)
            //Spelled State
            let spelledState = ''
            axios.get('https://worldpopulationreview.com/static/states/name-abbr.json')
            .then(response =>{
                let states = Object.keys(response.data)
                states.forEach(state => {
                    if(response.data[state] == this.onboardingInformation.state){
                        spelledState = state
                    }
                })
            })

            //Agency Type Variables
            let beyondEntityType = ''
            let sterlingEntityType = ''
            let w9EntityType = ''
            let w9LLCType = ''

            if (this.onboardingInformation.agency_type === "Sole") {
                w9EntityType = "Sole";
                beyondEntityType = "Sole";
                sterlingEntityType = "Sole";
            } else if (this.onboardingInformation.agency_type === "C-Corp") {
                w9EntityType = "C Corp";
                beyondEntityType = "Corp";
                sterlingEntityType = "Corp";
            } else if (this.onboardingInformation.agency_type === "S-Corp") {
                w9EntityType = "S Corp";
                beyondEntityType = "Corp";
                sterlingEntityType = "Corp";
            } else if (this.onboardingInformation.agency_type === "Partner") {
                w9EntityType = "Partner";
                beyondEntityType = "Partner";
                sterlingEntityType = "Partner";
            } else if (this.onboardingInformation.agency_type === "Trust") {
                w9EntityType = "Trust";
                beyondEntityType = "Partner";
                sterlingEntityType = "Partner";
            } else if (this.onboardingInformation.agency_type === "LCC-C") {
                w9EntityType = "LLC";
                w9LLCType = "C";
                beyondEntityType = "LLC";
                sterlingEntityType = "Corp";
            } else if (this.onboardingInformation.agency_type === "LLC-S") {
                w9EntityType = "LLC";
                w9LLCType = "S";
                beyondEntityType = "LLC";
                sterlingEntityType = "Corp";
            } else if (this.onboardingInformation.agency_type === "LLC-P") {
                w9EntityType = "LLC";
                w9LLCType = "P";
                beyondEntityType = "LLC";
                sterlingEntityType = "Partner";
            }

            //Seperate Tax ID
            const tax = this.onboardingInformation.agency_tax_id.replace("-", '').split("")
            let tax1 = ''
            let tax2 = ''
            let tax3 = ''
            let tax4 = ''
            let tax5 = ''
            let tax6 = ''
            let tax7 = ''
            let tax8 = ''
            let tax9 = ''
            let i = 1
            tax.forEach(item => {
                if(i === 1){tax1 = item} else if(i === 2){tax2 = item} else if(i === 3){tax3 = item} else if(i === 4){tax4 = item} else if(i === 5){tax5 = item} else if(i === 6){tax6 = item} else if(i === 7){tax7 = item} else if(i === 8){tax8 = item} else if (i === 9){tax9 = item}
                i += 1
            })

            const myHeaders = {
                headers: {'Authorization': `API-Key ${this.apiData.apiKey}`, 'Content-Type': 'application/json'}
            }

            const raw = {
                "name": `RocketMGA - ${this.onboardingInformation.agency_name} Onboarding`,
                "template_uuid": `${this.apiData.templateID}`,
                "recipients": [
                    {
                    "email": this.onboardingInformation.email,
                    "first_name": this.onboardingInformation.first_name,
                    "last_name": this.onboardingInformation.last_name,
                    "role": "Client"
                    }
                ],
                "tokens": [
                    {
                        "name": 'RMGAid',
                        "value": this.onboardingInformation.rocketMGA_id
                    },
                    {
                        "name": "agentName",
                        "value": `${this.onboardingInformation.first_name} ${this.onboardingInformation.last_name}`
                    },
                    {
                        "name": "agentTitle",
                        "value": "Princepal"
                    },
                    {
                        "name": "agentLicense",
                        "value": this.onboardingInformation.agent_license
                    },
                    {
                        "name": "agencyName",
                        "value": this.onboardingInformation.agency_name
                    },
                    {
                        "name": "agencyDBAname",
                        "value": this.onboardingInformation.dba_name
                    },
                    {
                        "name": "agencyPhone",
                        "value": this.onboardingInformation.phone
                    },
                    {
                        "name": "agencyEmail",
                        "value": this.onboardingInformation.email
                    },
                    {
                        "name": "agencyState",
                        "value": this.onboardingInformation.state
                    },
                    {
                        "name": "agencyAddress",
                        "value": this.onboardingInformation.address_1 + " " + this.onboardingInformation.address_2
                    },
                    {
                        "name": "agencyCityStateZip",
                        "value": `${this.onboardingInformation.city}, ${this.onboardingInformation.state} ${this.onboardingInformation.zip}`
                    },
                    {
                        "name": "agencyMailingAddress",
                        "value": this.onboardingInformation.address_1 + " " + this.onboardingInformation.address_2
                    },
                    {
                        "name": "agencyMailingCityStateZip",
                        "value": `${this.onboardingInformation.city}, ${this.onboardingInformation.state} ${this.onboardingInformation.zip}`
                    },
                    {
                        "name": "agencyTaxID",
                        "value": this.onboardingInformation.agency_tax_id
                    },
                    {
                        "name": "agencyLicense",
                        "value": this.onboardingInformation.agency_license
                    },
                    {
                        "name": "date",
                        "value": today
                    },
                    {
                        "name": "haveBeyond",
                        "value": this.onboardingInformation.beyond
                    },
                    {
                        "name": "haveFlow",
                        "value": this.onboardingInformation.flow
                    },
                    {
                        "name": "haveSterling",
                        "value": this.onboardingInformation.sterling
                    },
                    {
                        "name": "w9EntityType",
                        "value": w9EntityType
                    },
                    {
                        "name": "w9LLCType",
                        "value": w9LLCType
                    },
                    {
                        "name": "beyondEntityType",
                        "value": beyondEntityType
                    },
                    {
                        "name": "sterlingEntityType",
                        "value": sterlingEntityType
                    },
                    {
                        "name": "ddmm",
                        "value": ddmm
                    },
                    {
                        "name": "spelledState",
                        "value": spelledState
                    },
                    {
                        "name": "tax1",
                        "value": tax1
                    },
                    {
                        "name": "tax2",
                        "value": tax2
                    },
                    {
                        "name": "tax3",
                        "value": tax3
                    },
                    {
                        "name": "tax4",
                        "value": tax4
                    },
                    {
                        "name": "tax5",
                        "value": tax5
                    },
                    {
                        "name": "tax6",
                        "value": tax6
                    },
                    {
                        "name": "tax7",
                        "value": tax7
                    },
                    {
                        "name": "tax8",
                        "value": tax8
                    },
                    {
                        "name": "tax9",
                        "value": tax9
                    }
                ],
                "fields": {
                    "w9EntityType": {  
                        "value": w9EntityType,
                        "role": "Client"
                    }
                }
            };

            await axios.post('https://api.pandadoc.com/public/v1/documents', raw, myHeaders)
            .then(response => {
                this.onboardingInformation.document_id = response.data.id
            })

            //Save document id to database
            await axios.put('/api/user/update/' + this.userID, {
                "user": {
                    "document_id": this.onboardingInformation.document_id
                }
            })

            //Update Stage
            await axios.put('/api/user/update/' + this.userID, {
                "user": {
                    "stage": "portal_agreement"
                }
            })

            //Send Document
            setTimeout(() =>{
                this.sendDocument()
            }, 5500);
        },
        async sendDocument(){
            const myHeaders = {
                headers: {'Authorization': `API-Key ${this.apiData.apiKey}`, 'Content-Type': 'application/json'}
            }

            const raw = {
                "message": "Welcome to RocketMGA - Almost There!",
                "silent": true
            }
            
            await axios.post(`https://api.pandadoc.com/public/v1/documents/${this.onboardingInformation.document_id}/send`, raw, myHeaders)
            
            this.getEmbedID()
        },
        async getEmbedID(){
            const myHeaders = {
                headers: {'Authorization': `API-Key ${this.apiData.apiKey}`, 'Content-Type': 'application/json'}
            }

            const raw = {
                "recipient": `${this.onboardingInformation.email}`,
                "lifetime": 9999999
            }

            await axios.post(`https://api.pandadoc.com/public/v1/documents/${this.onboardingInformation.document_id}/session`, raw, myHeaders)
            .then(response => {
                this.onboardingInformation.embed_id = response.data.id
            })

            //Update database with embed id
            await axios.put('/api/user/update/' + this.userID, {
                "user": {
                    "embed_id": this.onboardingInformation.embed_id
                }
            })

            //Enabled Submit and Back Buttons
            this.submitDisabled = false;
            this.backDisabled = false;
        }
    },
    validations () {
        return {
            onboardingInformation: {
                first_name: {required: helpers.withMessage('First name required.', required), minLengthValue: helpers.withMessage('First name needs to be atlest 3 characters.', minLength(3))},
                last_name: {required: helpers.withMessage('Last name required.', required), minLengthValue: helpers.withMessage('Last name needs to be atlest 3 characters.', minLength(3))},
                agency_name: {required: helpers.withMessage('Agency name required.', required), minLengthValue: helpers.withMessage('Agency name needs to be atlest 3 characters.', minLength(3))},
                dba_name: {required: helpers.withMessage('DBA name required.', required), minLengthValue: helpers.withMessage('DBA name needs to be atlest 3 characters.', minLength(3))},
                phone: {required, minLengthValue: helpers.withMessage('Please enter a 10 digit phone number.', minLength(14)), maxLengthValue: helpers.withMessage('Please enter a 10 digit phone number.', maxLength(14))},
                email: {required: helpers.withMessage('Email required.', required), email: helpers.withMessage('Please enter a valid email.', email)},
                address_1: {required: helpers.withMessage('Address required.', required)},
                agency_license: {required: helpers.withMessage('Agency License is required', required)},
                agency_tax_id: {required: helpers.withMessage('Tax ID required.', required), minLengthValue: helpers.withMessage('Please enter a 9 digit tax id.', minLength(10))},
                agency_type: {required: helpers.withMessage('Agency type required.', required)},
                agent_license: {required: helpers.withMessage('Agent License required.', required)},
                agent_npn: {required: helpers.withMessage('Agent NPN required.', required), minLengthValue: helpers.withMessage('Please enter a valid 7 digit npn.', minLength(7))},
                agent_license_eff: {required: helpers.withMessage('License eff date required.', required)},
                agent_license_exp: {required: helpers.withMessage('License exp date required.', required)},
                eo_exp: {required: helpers.withMessage('E&O exp required.', required)},
                eo_policy: {required: helpers.withMessage('E&O policy number required.', required)},
                eo_limit: {required: helpers.withMessage('E&O limit required.', required)},
                eo_insurer: {required: helpers.withMessage('E&O insurer required.', required)}
            }
        }
    },
    directives: {mask},
    components: {
        VueGoogleAutocomplete,
        VueNumeric,
        loading
    }
}
</script>

<style>
.rotationtransition{
    transition: transform 0.5s ease-in-out;
}
</style>