<div>
    <div class="row">

        <div class="col-md-12">
            @if (session()->has('success'))
                <span class="text-success">
                            {{ session('success') }}
                        </span>
            @endif

            @if (session()->has('error'))
                <span class="text-danger">
                            {{ session('error') }}
                        </span>
            @endif
        </div>


        <div class="col-md-6">
            <div class="form-group">
                <label>Chose PO System</label>
                <select class="form-control select2bs4" style="width: 100%;" wire:model="selectedPO">
                    <option value="0">Please Select PO</option>
                    <option value="sap">SAP</option>
                    <option value="mowared">MOWARED</option>
                </select>
            </div>
            <!-- /.form-group -->
            <div class="form-group" wire:loading.remove>
                <label for="exampleInputFile">Upload File</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" wire:model="po_file">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text" wire:click="uploadfile">Upload</span>
                    </div>
                </div>
            </div>

            <div wire:loading>
                Processing Please wait...
            </div>
            <!-- /.form-group -->
        </div>
        <!-- /.col -->
    </div>
</div>
