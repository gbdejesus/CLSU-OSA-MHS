<template>
    <div class="card" style="color: black;">
        <div v-if="user.two_fa_verified || user.two_fa_verified === '1'">
            <div class="card-header" style="background: #003a10;">
                <h2 style="margin: 0 !important; vertical-align: middle; text-align: center; color: white;">
                    <span v-if="(user.role !== 'ADMIN' && user.evaluated === 1) && user.clients !== null">MANAGEMENT</span>
                    <span v-else-if="user.role === 'CLIENT'">
                        <div v-if="user.evaluated === 1">
                            <span v-if="user.counselors === null">CHOOSE THE COUNSELOR YOU PREFER</span>
                            <span v-else>CONVERSATIONS</span>
                        </div>
                        <div v-else>
                            <span>MENTAL HEALTH INITIAL ASSESSMENT</span>
                        </div>
                    </span>
                    <span v-else-if="user.role === 'COUNSELOR'">CONVERSATIONS</span>
                </h2>
            </div>
            <div class="card-body">
                <div class="chat-app" v-if="user.role === 'COUNSELOR'">
                    <div class="col-md-12">
                        <vue-advanced-chat
                            height="calc(70vh - 10px)"
                            :current-user-id="user.id"
                            :rooms-loaded="true"
                            :show-files="false"
                            :room-info-enabled="true"
                            :rooms="JSON.stringify(contacts)"
                            :menu-actions="JSON.stringify(menuActions)"
                            :messages="JSON.stringify(messages)"
                            :messages-loaded="messagesLoaded"
                            @menu-action-handler="menuActionHandler($event.detail[0])"
                            @send-message="saveNewMessage($event.detail[0])"
                            @fetch-messages="startConversationWith($event.detail[0])">
                        </vue-advanced-chat>
                    </div>
                </div>
                <div class="chat-app" v-if="user.role === 'CLIENT'">
                    <div class="col-md-12" v-if="user.evaluated === 1">
                        <div class="col-md-12" v-if="user.counselors === null">
                            <pick-counselors :user-id="user.id"></pick-counselors>
                        </div>
                        <div class="col-md-12" v-else>
                            <vue-advanced-chat
                                height="calc(70vh - 10px)"
                                :audio="false"
                                :current-user-id="user.id"
                                :rooms-loaded="true"
                                :loading-rooms="loadingRooms"
                                :rooms="JSON.stringify(contacts)"
                                :room-actions="JSON.stringify(roomActions)"
                                :messages="JSON.stringify(messages)"
                                :messages-loaded="messagesLoaded"
                                @send-message="saveNewMessage($event.detail[0])"
                                @fetch-messages="startConversationWith($event.detail[0])"
                            />
                        </div>
                    </div>
                    <div class="col-md-12" v-else>
                        <evaluation :user-id="user.id"></evaluation>
                    </div>
                </div>
                <div class="chat-app" v-else-if="user.role === 'ADMIN'">
                    <div class="col-md-12">
                        <user-management></user-management>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <div class="text-center align-items-center rgba-black-strong py-5 px-4 justify-content-center two-fa-form">
                <h2 class="text-success">2FA Security</h2>

                <div class="alert alert-success" v-if="twoFaApiNotif.show && twoFaApiNotif.success">
                    <strong>Success! You may now redirected to dashboard.</strong>
                </div>
                <div class="alert alert-danger" v-if="twoFaApiNotif.show && !twoFaApiNotif.success">
                    <strong>{{ twoFaApiNotif.message }}</strong>
                </div>

                <h5 class="">
                    Protecting your account privacy is our top priority. Please enter the 6-digits authorization code sent to your email
                    <h4>{{ censoredEmail }}</h4>
                </h5>
                <p class="mb-2">
                    <i>Please check your Junk/Spam folder if you cant find it in the main list.</i>
                </p>
                <form>
                    <div class="row pt-2 mb-2">
                        <div class="col-lg-2 col-md-2 col-2 ps-0 ps-md-2">
                            <input type="text" class="form-control text-lg text-center two-fa-input" id="two-fa-input-1" placeholder="_" aria-label="2fa" maxlength="1" v-model="code.first" @keyup.delete="deleteFocus($event, 1)" v-on:input="nextPlease($event,1)">
                        </div>
                        <div class="col-lg-2 col-md-2 col-2 ps-0 ps-md-2">
                            <input type="text" class="form-control text-lg text-center two-fa-input" id="two-fa-input-2" placeholder="_" aria-label="2fa" maxlength="1" v-model="code.second" @keyup.delete="deleteFocus($event, 2)" v-on:input="nextPlease($event,2)">
                        </div>
                        <div class="col-lg-2 col-md-2 col-2 ps-0 ps-md-2">
                            <input type="text" class="form-control text-lg text-center two-fa-input" id="two-fa-input-3" placeholder="_" aria-label="2fa" maxlength="1" v-model="code.third" @keyup.delete="deleteFocus($event, 3)" v-on:input="nextPlease($event,3)">
                        </div>
                        <div class="col-lg-2 col-md-2 col-2 pe-0 pe-md-2">
                            <input type="text" class="form-control text-lg text-center two-fa-input" id="two-fa-input-4" placeholder="_" aria-label="2fa" maxlength="1" v-model="code.fourth" @keyup.delete="deleteFocus($event, 4)" v-on:input="nextPlease($event,4)">
                        </div>
                        <div class="col-lg-2 col-md-2 col-2 pe-0 pe-md-2">
                            <input type="text" class="form-control text-lg text-center two-fa-input" id="two-fa-input-5" placeholder="_" aria-label="2fa" maxlength="1" v-model="code.fifth" @keyup.delete="deleteFocus($event, 5)" v-on:input="nextPlease($event,5)">
                        </div>
                        <div class="col-lg-2 col-md-2 col-2 pe-0 pe-md-2">
                            <input type="text" class="form-control text-lg text-center two-fa-input" id="two-fa-input-6" placeholder="_" aria-label="2fa" maxlength="1" v-model="code.sixth" @keyup.delete="deleteFocus($event, 6)" v-on:input="nextPlease($event,6)">
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn bg-success btn-lg my-4" @click="submitTwoFaVerification">Submit</button>
                    </div>
                </form>
                <br>
                <hr>
                <br>
                <h5 class="mb-4">
                    <div class="alert alert-success" v-if="showResendApiNotif">
                        <strong>A New Authentication Code has been sent to your registered email.</strong>
                    </div>
                    Code Expired? <br>
                    You can reset the Two Factor Authentication here by clicking this button.
                    <div class="text-center">
                        <button type="button" class="btn bg-info btn-lg my-4" @click="resetTwoFactorAuthentication()">Resend</button>
                    </div>
                </h5>
            </div>
        </div>

        <button type="button" data-toggle="modal" data-target="#evaluation" style="display: none;" ref="evaluation">
            hidden button show evaluation
        </button>
        <div class="modal" id="evaluation">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 800px !important;">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">EVALUATION</h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <span style="font-size: 30px;">Evaluation Score: {{ selectedContact.room.evaluation_score }}</span>
                        <h4>
                            <span v-if="selectedContact.room.evaluation_score <= 19" style="color: red;">
                                "Need Professional Help"
                            </span>
                            <span v-else-if="selectedContact.room.evaluation_score >= 20 && selectedContact.room.evaluation_score <= 34" style="color: orange;">
                                "Normal State of Mental Health"
                            </span>
                            <span v-else-if="selectedContact.room.evaluation_score >= 35 && selectedContact.room.evaluation_score <= 45" style="color: green;">
                                "Mentally Healthy"
                            </span>
                        </h4>

                        <div class="mt-4" v-if="selectedContact.room">
                            <div v-for="(evaluation, index) in selectedContact.room.evaluation_details" style="margin-bottom: 15px;">
                                <div class="form-check">
                                    <label class="form-label">
                                        <h5> {{ index + 1 }}. {{ evaluation.description }} </h5>
                                    </label>
                                </div>
                                <div class="form-check-inline" v-for="option in evaluation.options">
                                    <label class="form-check-label" style="font-size: 16px">
                                        <input type="radio" class="form-check-input" disabled
                                               :name="'evaluation-'+evaluation.id + '-' + option.label"
                                               :value="option.value"
                                               v-model="evaluation.answer">
                                        {{ option.label }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <div>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <button type="button" data-toggle="modal" data-target="#student-profile" style="display: none;" ref="profile">
            hidden button show profile
        </button>
        <div class="modal" id="student-profile">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Student Profile</h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">

<!--                        <span>Name: {{ selectedContact.room.name }} </span> <br>-->
<!--                        <span>Student ID: {{ selectedContact.room.student_id }} </span> <br>-->
<!--                        <span>Course: {{ selectedContact.room.course }} </span> <br>-->
<!--                        <span>Year Level & Section: {{ selectedContact.room.yearLevel }} - {{ selectedContact.room.section }} </span> <br>-->
                        <div>
                            <img :src="selectedContact.room.avatar" alt="student_picture.jpeg" style="width:50%; clip-path: circle();"><br>
                            <h3>{{ selectedContact.room.name }}</h3>
                            <span style="font-size: 20px; font-weight: bolder;"># {{ selectedContact.room.student_id }}</span><br>
                            <span style="font-size: 20px; font-weight: bolder;">{{ selectedContact.room.course }}</span>
                            <span style="font-size: 20px; font-weight: bolder;">{{ selectedContact.room.year_level }} - {{ selectedContact.room.section }}</span><br>
                            <span style="font-size: 20px; font-weight: bolder;">{{ selectedContact.room.email }}</span><br>
                            <span style="font-size: 20px; font-weight: bolder;">{{ selectedContact.room.phone }}</span><br>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <div>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import { register } from 'vue-advanced-chat';
    register();

    import Conversation from './Conversation';
    import ContactList from './ContactList';
    import UserManagement from './UserManagement';
    import Evaluation from './Evaluation';
    import PickCounselors from "./PickCounselors.vue";

    export default {
        components:{
            ContactList, Conversation, UserManagement, Evaluation, PickCounselors
        },
        data: function() {
            return {
                messages: [],
                contacts: [],
                selectedContact: {
                    options: {},
                    room: {
                        evaluation_details: []
                    }
                },
                messagesLoaded: false,
                showEvaluationModal: false,
                loadingRooms: true,
                roomActions: [
                    // { name: 'inviteUser', title: 'Invite User' },
                    // { name: 'removeUser', title: 'Remove User' },
                    // { name: 'deleteRoom', title: 'Delete Room' }
                ],
                menuActions: [
                    { name: 'checkEvaluationScore', title: 'Check Evaluation' },
                    { name: 'viewStudentProfile', title: 'View Student Profile' }
                ],
                templatesText: [
                    {
                        tag: "Hello",
                        text: "Hello, how are you?"
                    },
                    {
                        tag: "Hi",
                        text: "Hi, how are you?"
                    }
                ],
                search: {
                    name: '',
                    email: '',
                    role: ''
                },
                result: null,
                code: {
                    first: '',
                    second: '',
                    third: '',
                    fourth: '',
                    fifth: '',
                    sixth: ''
                },
                twoFaApiNotif: {
                    show: false,
                    success: false,
                    message: ''
                },
                showResendApiNotif: false,
                testBool: true,
            }
         },
        props:{
            user: {
                type: Object,
                required: true
            }
        },
        mounted () {

            this.token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            Echo.private('private-messages_' + this.user.id)
            .listen('NewMessage', (e) => {
                this.handleIncoming(e.message)
            });

            axios.get('/api/contact-list/'+ this.user.id)
            .then( response => {
                this.contacts = response.data;
                this.messagesLoaded = true;
            })
            .catch( error => {
                console.log( error );
            })

            setTimeout(() => this.loadingRooms = false, 1000);
        },
        computed: {
            censoredEmail: function(){
                const email = this.user.email;
                return email.replace(/(\w{3})[\w.-]+@([\w.]+\w)/, "$1***@$2")
            }
        },
        methods: {
            nextPlease: function (event, number) {
                let input = number + 1;
                if (number === 6) {
                    return;
                }
                document.getElementById('two-fa-input-' + input).focus();

            },

            deleteFocus: function (event, number) {
                // let input = number - 1;
                // if (number === 1) {
                //     return;
                // }
                // document.getElementById('two-fa-input-' + input).focus();
                // document.getElementById('two-fa-input-' + input).value = '';
            },

            submitTwoFaVerification: function () {
                if (
                    this.code.first
                    &&
                    this.code.second
                    &&
                    this.code.third
                    &&
                    this.code.fourth
                    &&
                    this.code.fifth
                    &&
                    this.code.sixth
                ) {
                    this.twoFaApiNotif.show = false;
                    let code = this.code.first + this.code.second + this.code.third + this.code.fourth + this.code.fifth + this.code.sixth;
                    axios.post('/api/submit/2fa', {
                        userId: this.user.id,
                        code: code
                    }).then((response) => {
                        console.log(response.data);
                        this.twoFaApiNotif.show = true;
                        this.twoFaApiNotif.success = response.data.success;
                        this.twoFaApiNotif.message = response.data.message;

                        if (response.data.success) {
                            window.location.reload();
                        }
                        // this.$emit('send', response.data)
                    })
                        .catch(error => {
                            console.log(error);
                        }
                    )
                }
            },

            resetTwoFactorAuthentication: function () {
                this.showResendApiNotif = false;
                axios.post('/api/reset/2fa', {
                    userId: this.user.id
                }).then((response) => {
                    this.showResendApiNotif = true;
                })
                .catch(error => {
                        console.log(error);
                    }
                )
            },

            startConversationWith (contact) {
                this.updateUnreadCount(contact, true);
                axios.get('/api/conversation/' + contact.room.id + '/' + this.user.id )
                .then( response => {
                    this.messages = response.data;
                    this.selectedContact = contact;
                })
                .catch( error => {
                    console.log( error );
                })
            },

            updateContacts: function () {
                axios.get('/api/contact-list/'+ this.user.id)
                    .then( response => {
                        this.contacts = response.data;
                        this.messagesLoaded = true;
                    })
                    .catch( error => {
                        console.log( error );
                    })
            },

            saveNewMessage (msg) {

                if (! this.selectedContact.room) {
                    return;
                }

                axios.post('/api/conversation/send', {
                    from: this.user.id,
                    to: this.selectedContact.room.id,
                    sender_id: this.user.id,
                    receiver_id: this.selectedContact.room.id,
                    text: msg
                }).then((response) => {
                    // console.log(response.data);
                    // this.$emit('send', response.data)
                    this.messages.push(response.data);
                })
                    .catch(error => {
                        console.log(error);
                    })

                this.updateContacts();
            },
            handleIncoming (message) {

                console.log(message)
                if (message.to === this.selectedContact.room.id) {
                    this.saveNewMessage(message);
                }

                if (message.from === this.selectedContact.room.id ) {
                    message._id = message.id;
                    message.senderId = message.from;
                    message.content = message.text;
                    var date = new Date(message.created_at);
                    date.setSeconds(45); // specify value for SECONDS here
                    var timeString = date.toISOString().substring(11, 19);
                    message.timestamp = timeString;
                    this.messages.push(message);
                    this.updateUnreadCount(message.from_contact, false);
                }

                // message._id = message.id;
                // message.senderId = message.from;
                // message.content = message.text;
                // var date = new Date(message.created_at);
                // date.setSeconds(45); // specify value for SECONDS here
                // var timeString = date.toISOString().substring(11, 19);
                // message.timestamp = timeString;
                // this.messages.push(message);
                // this.updateUnreadCount(message.from_contact, false);

                this.updateContacts();

            },
            updateUnreadCount (contact, reset) {
                this.contacts == this.contacts.map((single) => {
                    if(single.id != contact.id){
                        return single;
                    }
                    if(reset){
                        single.unread = 0;
                    }
                    else{
                        single.unread += 1;
                        }
                    return single;

                })

                this.updateContacts();
            },
            menuActionHandler ({ roomId, action }) {
                console.log(action.name)
                switch (action.name) {
                    case 'checkEvaluationScore':
                        let evaluation = this.$refs.evaluation;
                        evaluation.click();
                        break;
                    case 'viewStudentProfile':
                        let profile = this.$refs.profile;
                        profile.click();
                        break;
                    default:
                        break;
                }
            },
            closeModal: function () {
                this.showEvaluationModal = false;
            },
            roomInfoAction: function () {
                alert('HELLO')
            }


        }
    }
</script>

<style lang="scss" scoped>
    .chat-app {
        display: flex;
    }
    .student {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        max-width: 300px;
        margin: auto;
        text-align: center;
        font-family: arial;
    }
    .title {
        color: grey;
        font-size: 18px;
    }
    button {
        border: none;
        outline: 0;
        display: inline-block;
        padding: 8px;
        color: white;
        background-color: #000;
        text-align: center;
        cursor: pointer;
        width: 100%;
        font-size: 18px;
    }
    a {
        text-decoration: none;
        font-size: 22px;
        color: black;
    }
    button:hover, a:hover {
        opacity: 0.7;
    }
    .txt-center {
        text-align: center;
    }
    body {
        height: 100vh;
        font-family: 'Poppins',sans-serif;
        background: url("https://wallpaperplay.com/walls/full/b/3/7/329976.jpg");
        background-repeat: no-repeat;
        background-size: cover;
    }
    .card {
        box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
    }
    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0,0,0,.125);
        border-radius: 1rem;
    }
    .img-thumbnail {
        padding: .25rem;
        background-color: #ecf2f5;
        border: 1px solid #dee2e6;
        border-radius: .25rem;
        max-width: 100%;
        height: auto;
    }
    .avatar-lg {
        height: 150px;
        width: 150px;
    }
    .two-fa-input {
        font-weight: bolder;
        text-transform: capitalize;
        border: solid 0.3px #fcd602;
    }
    .two-fa-message {
        font-size: 24px;
    }
    .two-fa-form {
        margin-left: 300px;
        margin-right: 300px;
    }
    @media screen and (max-width: 1080px) {
        .two-fa-form {
            margin-left: 0;
            margin-right: 0;
        }
    }
</style>
