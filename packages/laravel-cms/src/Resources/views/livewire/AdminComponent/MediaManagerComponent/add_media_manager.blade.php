<div class="row">
    <div class="col-12 col-md-12 col-lg-12  media-scroll ">
        <div class="dropZone"
        >

            <div class="dropZone-info" @change="onFileSelected">
                <span class="fa fa-cloud-upload dropZone-title"></span>
                <span class="dropZone-title">Drop file or click to upload</span>
                <div class="dropZone-upload-limit-info">
                    <div>extension support: (all standard extensions)</div>
                    <div>maximum file size: {{ini_get("upload_max_filesize")}}B
                        <br>
                        <br>
                        <button id="button" ref="button" @click="uploadfile"
                                class="btn flat bg-orange"><i class="fas fa-cloud-upload-alt"></i>
                            Upload a File
                        </button>
                    </div>

                </div>
            </div>
            <input type="file" ref="myFile" multiple wire:model="mediaFile" >
        </div>

        <div class="text-center mt-5">
            <img class="mx-auto w-32 "
                 src="https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png"
                 alt="no data"/>
            <span class="text-small text-gray-500">No files selected</span>
        </div>

        <div>
            <div class="text-center mt-5 table-responsive p-0  add-media-scroll">
                <table class="table table-hover text-nowrap">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Media</th>
                        <th>Media Type</th>
                        <th>Media Visibility</th>
                        <th>Media Name</th>
                        <th style="width: 30px">Edit</th>
                        <th style="width: 30px">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1.</td>
                        <td><img src="https://via.placeholder.com/300/FFFFFF?text=1" width="60px"
                                 class="img-fluid mb-2 text-left"
                                 alt="white sample"/></td>
                        <td>
                            image/jpeg
                        </td>

                        <td>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                <label class="custom-control-label" for="customSwitch1"><span
                                        class="badge bg-maroon">Private</span> </label>
                            </div>
                        </td>
                        <td>
                            image name
                        </td>
                        <td><span class="badge bg-info"><i class="fa fa-edit"></i>edit image</span></td>
                        <td><span class="badge bg-danger"><i class="fa fa-trash"></i></span></td>
                    </tr>

                    <tr>
                        <td>2.</td>
                        <td><img src="https://via.placeholder.com/300/FFFFFF?text=1" width="60px"
                                 class="img-fluid mb-2 text-left"
                                 alt="white sample"/></td>
                        <td>
                            document/pdf
                        </td>
                        <td>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                <label class="custom-control-label" for="customSwitch1"><span
                                        class="badge bg-maroon">Private</span> </label>
                            </div>
                        </td>
                        <td>
                            pdf name
                        </td>
                        <td><span class="badge bg-info"><i class="fa fa-edit"></i>edit image</span></td>
                        <td><span class="badge bg-danger"><i class="fa fa-trash"></i></span></td>
                    </tr>

                    <tr>
                        <td>2.</td>
                        <td><img src="https://via.placeholder.com/300/FFFFFF?text=1" width="60px"
                                 class="img-fluid mb-2 text-left"
                                 alt="white sample"/></td>
                        <td>
                            document/pdf
                        </td>
                        <td>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                <label class="custom-control-label" for="customSwitch1"><span
                                        class="badge bg-maroon">Private</span> </label>
                            </div>
                        </td>
                        <td>
                            pdf name
                        </td>
                        <td><span class="badge bg-info"><i class="fa fa-edit"></i>edit image</span></td>
                        <td><span class="badge bg-danger"><i class="fa fa-trash"></i></span></td>
                    </tr>

                    <tr>
                        <td>2.</td>
                        <td><img src="https://via.placeholder.com/300/FFFFFF?text=1" width="60px"
                                 class="img-fluid mb-2 text-left"
                                 alt="white sample"/></td>
                        <td>
                            document/pdf
                        </td>
                        <td>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                <label class="custom-control-label" for="customSwitch1"><span
                                        class="badge bg-maroon">Private</span> </label>
                            </div>
                        </td>
                        <td>
                            pdf name
                        </td>
                        <td><span class="badge bg-info"><i class="fa fa-edit"></i>edit image</span></td>
                        <td><span class="badge bg-danger"><i class="fa fa-trash"></i></span></td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td><img src="https://via.placeholder.com/300/FFFFFF?text=1" width="60px"
                                 class="img-fluid mb-2 text-left"
                                 alt="white sample"/></td>
                        <td>
                            document/pdf
                        </td>
                        <td>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                <label class="custom-control-label" for="customSwitch1"><span
                                        class="badge bg-maroon">Private</span> </label>
                            </div>
                        </td>
                        <td>
                            pdf name
                        </td>
                        <td><span class="badge bg-info"><i class="fa fa-edit"></i>edit image</span></td>
                        <td><span class="badge bg-danger"><i class="fa fa-trash"></i></span></td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td><img src="https://via.placeholder.com/300/FFFFFF?text=1" width="60px"
                                 class="img-fluid mb-2 text-left"
                                 alt="white sample"/></td>
                        <td>
                            document/pdf
                        </td>
                        <td>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                <label class="custom-control-label" for="customSwitch1"><span
                                        class="badge bg-maroon">Private</span> </label>
                            </div>
                        </td>
                        <td>
                            pdf name
                        </td>
                        <td><span class="badge bg-info"><i class="fa fa-edit"></i>edit image</span></td>
                        <td><span class="badge bg-danger"><i class="fa fa-trash"></i></span></td>
                    </tr>  <tr>
                        <td>2.</td>
                        <td><img src="https://via.placeholder.com/300/FFFFFF?text=1" width="60px"
                                 class="img-fluid mb-2 text-left"
                                 alt="white sample"/></td>
                        <td>
                            document/pdf
                        </td>
                        <td>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                <label class="custom-control-label" for="customSwitch1"><span
                                        class="badge bg-maroon">Private</span> </label>
                            </div>
                        </td>
                        <td>
                            pdf name
                        </td>
                        <td><span class="badge bg-info"><i class="fa fa-edit"></i>edit image</span></td>
                        <td><span class="badge bg-danger"><i class="fa fa-trash"></i></span></td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td><img src="https://via.placeholder.com/300/FFFFFF?text=1" width="60px"
                                 class="img-fluid mb-2 text-left"
                                 alt="white sample"/></td>
                        <td>
                            document/pdf
                        </td>
                        <td>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                <label class="custom-control-label" for="customSwitch1"><span
                                        class="badge bg-maroon">Private</span> </label>
                            </div>
                        </td>
                        <td>
                            pdf name
                        </td>
                        <td><span class="badge bg-info"><i class="fa fa-edit"></i>edit image</span></td>
                        <td><span class="badge bg-danger"><i class="fa fa-trash"></i></span></td>
                    </tr>



                    </tbody>
                </table>
            </div>

        </div>



        @if($mediaFile)


        @endif
    </div>
</div>

@push('styles')
    <style>

        .dropZone {
            width: 100%;
            height: 200px;
            position: relative;
            border: 2px dashed #eee;
        }

        .dropZone:hover {
            border: 2px solid #2e94c4;
        }

        .dropZone:hover .dropZone-title {
            color: #1975A0;
        }

        .dropZone-info {
            color: #A8A8A8;
            position: absolute;
            top: 50%;
            width: 100%;
            transform: translate(0, -50%);
            text-align: center;
        }

        .dropZone-title {
            color: #787878;
        }

        .dropZone input {
            position: absolute;
            cursor: pointer;
            top: 0px;
            right: 0;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
        }

        .dropZone-upload-limit-info {
            display: flex;
            justify-content: flex-start;
            flex-direction: column;
        }

        .table:not(.table-dark) {
            color: inherit;
            text-align: left;
        }

    </style>
@endpush

@push('scripts')

    <script>
        $(function () {
            //Initialize Scrollbar
            $('.add-media-scroll').overlayScrollbars({
                height: '150px',

            })
        })

    </script>
@endpush
