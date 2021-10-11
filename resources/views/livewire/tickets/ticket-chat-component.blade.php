@push('styles')
    <style>
        .direct-chat-messages {
            -webkit-transform: translate(0,0);
            transform: translate(0,0);
            height: 351px !important;
            overflow: auto;
            padding: 10px;
        }
        .chat_template .direct-chat-text {
            width: 45%;
            border-radius: 20px;
        }
        .direct-chat-primary .right>.direct-chat-text {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
            float: right;
        }
        .chat_template .direct-chat-messages {
            padding: 24px;
        }
        .right .direct-chat-text {
            margin-left: 0;
            margin-right: 10px !important;
        }
        .predefine_msg li {
            display: inline-block;
            font-size: 16px;
            line-height: 1.25;
            border-radius: 13px;
            border: 1px solid rgba(20,118,242,.2);
            padding: 5px 20px;
        }
        .predefine_msg ul {
            list-style: none;
            margin-left: 0px !important;
            padding-left: 20px;
        }
        .predefine_msg li:hover {
            background: #f3f3f3;
        }
        .chat_send_btn input.form-control {
            border-radius: 20px;
            padding: 20px;
        }
        .chat_send_btn button.btn.btn-primary {
            padding: 2px 18px;
            border-radius: 0px 20px 20px 0px;
            font-size: 20px;
        }
        .upload_file_chat {
            overflow: hidden;
        }
        .upload_file_chat .btn.btn-file {
            overflow: hidden;
            position: relative;
            padding: 8px;
            border: none;
        }
        .upload_file_chat .btn.btn-default.btn-file {
            background: #fff !important;
        }
        .chat_send_btn input.form-control {
            border-right: 0px !important;
        }
        .upload_file_chat .btn.btn-default.btn-file {
            background: #fff !important;
            border: 1px solid #ced4da;
            border-left: 0px ;
            border-radius: 0px !important;
        }
        .file_name {
            padding: 0px 30px;
        }

        .badge {
            display: inline-block;
            padding: .25em .4em;
            font-size: 75%;
            font-weight: 200 !important;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25rem;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }

    </style>
@endpush
<div class="row">
    <div class="col-md-12">
        <div class="card  card-outline">
            <div class="card-header">
                <h3 class="card-title">Notification Type :
                    <span class="right badge" style="background: #dc3546; color: #fff; margin-left: 10px;">Enquiry Email</span>
                    <span class="right badge" style="background: #fec107; color: #fff; margin-left: 10px;">Expedite Email</span>
                    <span class="right badge" style="background: #27a844; color: #fff; margin-left: 10px;">Warning Email</span>
                    <span class="right badge" style="background: #17a2b7; color: #fff; margin-left: 10px;">Penalty Email</span>
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="form-group">

                    <h1><u>Heading Of Message </u></h1>
                    <h4>Subheading</h4>
                    <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain
                        was born and I will give you a complete account of the system, and expound the actual teachings
                        of the great explorer of the truth, the master-builder of human happiness. No one rejects,
                        dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know
                        how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again
                        is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain,
                        but because occasionally circumstances occur in which toil and pain can procure him some great
                        pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise,
                        except to obtain some advantage from it? But who has any right to find fault with a man who
                        chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that
                        produces no resultant pleasure? On the other hand, we denounce with righteous indignation and
                        dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so
                        blinded by desire, that they cannot foresee</p>
                    <ul>
                        <li>List item one</li>
                        <li>List item two</li>
                        <li>List item three</li>
                        <li>List item four</li>
                    </ul>
                    <p>Thank you,</p>
                    <p>John Doe</p>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<div class="row">
    <div class="col-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Line Items</h3>
            </div>
            <div class="">
                <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item active">
                            <a href="#" class="nav-link">
                                PO Item: 12333444
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a href="#" class="nav-link">
                                PO Item: 12333444
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a href="#" class="nav-link">
                                PO Item: 12333444
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a href="#" class="nav-link">
                                PO Item: 12333444
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a href="#" class="nav-link">
                                PO Item: 12333444
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a href="#" class="nav-link">
                                PO Item: 12333444
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="card direct-chat direct-chat-primary">

            <!-- /.card-header -->
            <div class="card-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages">
                    <!-- Message. Default to the left -->
                    <div class="direct-chat-msg">
                        <div class="direct-chat-infos clearfix">
                            <span class="direct-chat-name float-left">Alexander Pierce</span>
                            <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                        </div>
                        <!-- /.direct-chat-infos -->
                        <img class="direct-chat-img" src="{{URL('img/default_avatar.png')}}" alt="message user image">
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                            Is this template really for free? That's unbelievable!
                        </div>
                        <!-- /.direct-chat-text -->
                    </div>
                    <!-- /.direct-chat-msg -->

                    <!-- Message to the right -->
                    <div class="direct-chat-msg right">
                        <div class="direct-chat-infos clearfix">
                            <span class="direct-chat-name float-right">Sarah Bullock</span>
                            <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                        </div>
                        <!-- /.direct-chat-infos -->
                        <img class="direct-chat-img" src="{{URL('img/default_avatar.png')}}" alt="message user image">
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                            You better believe it!
                        </div>
                        <!-- /.direct-chat-text -->
                    </div>
                    <!-- /.direct-chat-msg -->

                    <!-- Message. Default to the left -->
                    <div class="direct-chat-msg">
                        <div class="direct-chat-infos clearfix">
                            <span class="direct-chat-name float-left">Alexander Pierce</span>
                            <span class="direct-chat-timestamp float-right">23 Jan 5:37 pm</span>
                        </div>
                        <!-- /.direct-chat-infos -->
                        <img class="direct-chat-img" src="{{URL('img/default_avatar.png')}}" alt="message user image">
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                            Working with AdminLTE on a great new app! Wanna join?
                        </div>
                        <!-- /.direct-chat-text -->
                    </div>
                    <!-- /.direct-chat-msg -->

                    <!-- Message to the right -->
                    <div class="direct-chat-msg right">
                        <div class="direct-chat-infos clearfix">
                            <span class="direct-chat-name float-right">Sarah Bullock</span>
                            <span class="direct-chat-timestamp float-left">23 Jan 6:10 pm</span>
                        </div>
                        <!-- /.direct-chat-infos -->
                        <img class="direct-chat-img" src="{{URL('img/default_avatar.png')}}" alt="message user image">
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                            I would love to.
                        </div>
                        <!-- /.direct-chat-text -->
                    </div>
                    <!-- /.direct-chat-msg -->

                </div>
                <!--/.direct-chat-messages-->

                <!-- Contacts are loaded here -->
                <div class="direct-chat-contacts">
                    <ul class="contacts-list">
                        <li>
                            <a href="#">
                                <img class="contacts-list-img" src="dist/img/user1-128x128.jpg" alt="User Avatar">

                                <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            Count Dracula
                            <small class="contacts-list-date float-right">2/28/2015</small>
                          </span>
                                    <span class="contacts-list-msg">How have you been? I was...</span>
                                </div>
                                <!-- /.contacts-list-info -->
                            </a>
                        </li>
                        <!-- End Contact Item -->
                        <li>
                            <a href="#">
                                <img class="contacts-list-img" src="dist/img/user7-128x128.jpg" alt="User Avatar">

                                <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            Sarah Doe
                            <small class="contacts-list-date float-right">2/23/2015</small>
                          </span>
                                    <span class="contacts-list-msg">I will be waiting for...</span>
                                </div>
                                <!-- /.contacts-list-info -->
                            </a>
                        </li>
                        <!-- End Contact Item -->
                        <li>
                            <a href="#">
                                <img class="contacts-list-img" src="dist/img/user3-128x128.jpg" alt="User Avatar">

                                <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            Nadia Jolie
                            <small class="contacts-list-date float-right">2/20/2015</small>
                          </span>
                                    <span class="contacts-list-msg">I'll call you back at...</span>
                                </div>
                                <!-- /.contacts-list-info -->
                            </a>
                        </li>
                        <!-- End Contact Item -->
                        <li>
                            <a href="#">
                                <img class="contacts-list-img" src="dist/img/user5-128x128.jpg" alt="User Avatar">

                                <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            Nora S. Vans
                            <small class="contacts-list-date float-right">2/10/2015</small>
                          </span>
                                    <span class="contacts-list-msg">Where is your new...</span>
                                </div>
                                <!-- /.contacts-list-info -->
                            </a>
                        </li>
                        <!-- End Contact Item -->
                        <li>
                            <a href="#">
                                <img class="contacts-list-img" src="dist/img/user6-128x128.jpg" alt="User Avatar">

                                <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            John K.
                            <small class="contacts-list-date float-right">1/27/2015</small>
                          </span>
                                    <span class="contacts-list-msg">Can I take a look at...</span>
                                </div>
                                <!-- /.contacts-list-info -->
                            </a>
                        </li>
                        <!-- End Contact Item -->
                        <li>
                            <a href="#">
                                <img class="contacts-list-img" src="dist/img/user8-128x128.jpg" alt="User Avatar">

                                <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            Kenneth M.
                            <small class="contacts-list-date float-right">1/4/2015</small>
                          </span>
                                    <span class="contacts-list-msg">Never mind I found...</span>
                                </div>
                                <!-- /.contacts-list-info -->
                            </a>
                        </li>
                        <!-- End Contact Item -->
                    </ul>
                    <!-- /.contacts-list -->

                </div>
                <!-- /.direct-chat-pane -->
            </div>

            <div class="predefine_msg">
                <ul>
                    <li><a href="#"><span>Hello!</span></a></li>
                    <li><a href="#"><span>Welcome To Skyview!</span></a></li>
                    <li><a href="#"><span>Hello!</span></a></li>
                    <li><a href="#"><span>Hello!</span></a></li>
                    <li><a href="#"><span>Welcome To Skyview!</span></a></li>
                    <li><a href="#"><span>Hello!</span></a></li>
                </ul>
            </div>
            <div class="file_name">
                <p>WhatsApp Image.pdf</p>
            </div>

            <!-- /.card-body -->
            <div class="card-footer">
                <form action="#" method="post">
                    <div class="input-group chat_send_btn">
                        <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                        <div class="upload_file_chat">
                            <div class="btn btn-default btn-file">
                                <i class="fas fa-paperclip"></i>
                                <input type="file" name="attachment">
                            </div>
                        </div>
                        <span class="input-group-append ">
                      <button type="button" class="btn btn-primary"><i class="fas fa-paper-plane"></i></button>
                    </span>
                    </div>
                </form>
            </div>
            <!-- /.card-footer-->
        </div>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
