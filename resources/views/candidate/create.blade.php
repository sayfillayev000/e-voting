<x-layout>

    <x-slot:title>Ovoz berganlar</x-slot:title>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Ovozberganlar</h1>
        <div class="d-flex justify-content-end">
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal"
                data-target="#addVotersModal">
                <i class="fas fa-plus fa-sm mr-1"></i> Add
            </a>
        </div>
    </div>

    @if ($errors->any() || session('message'))
        <div class="alert alert-{{ $errors->any() ? 'danger' : 'success' }} alert-dismissible fade show mx-auto my-4"
            role="alert">
            @foreach ($errors->all() as $error)
                <strong>{{ $error }}</strong><br>
            @endforeach
            @if (session('message'))
                {{ session('message') }}
            @endif
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Add New Candidate</h5>
                    </div>
                    <div class="card-body">
                        <form action="/candidate" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter name" required>
                            </div>

                            <div class="form-group">
                                <label for="picture">Picture</label>
                                <input type="file" class="form-control" id="picture" name="picture"
                                    accept="image/*">
                                <small class="form-text text-muted">Optional. Upload a profile picture.</small>
                            </div>

                            <div class="form-group">
                                <label for="resume">Resume</label>
                                <input type="file" class="form-control" id="resume" name="resume"
                                    accept="application/pdf">
                                <small class="form-text text-muted">Optional. Upload a PDF resume.</small>
                            </div>

                            <div class="form-group">
                                <label for="election_number">Election Number</label>
                                <input type="number" class="form-control" id="election_number" name="election_number"
                                    placeholder="Enter election number" required>
                            </div>

                            <button type="submit" class="btn btn-success btn-block">Add Candidate</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>
