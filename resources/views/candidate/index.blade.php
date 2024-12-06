<x-layout>

    <x-slot:title>Ovoz berganlar</x-slot:title>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Ovozberganlar</h1>
        <div class="d-flex justify-content-end">
            <a href="{{ route('candidate.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"
                data-toggle="modal" data-target="#addVotersModal">
                <i class="fas fa-plus fa-sm mr-1">
                </i>
                Nomzod Qo'shish
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

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Voters Table</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Ism</th>
                            <th>Rasmi</th>
                            <th>Resume</th>
                            <th>Ovozlar soni</th>
                            <th>O'zgartirish</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($candidates as $candidate)
                            <tr>
                                <td>{{ $candidate->name }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $candidate->picture) }}" class="rounded-circle"
                                        alt="Avatar" style="width: 100px; height: 100px; object-fit: cover;">
                                </td>
                                <td>
                                    <a href="{{ route('candidate.resume.download', $candidate->id) }}"
                                        class="btn btn-primary btn-sm">
                                        <i class="fas fa-download"></i> Resume Yuklab olish {{ $candidate->resume }}
                                    </a>
                                </td>
                                <td>{{ $candidate->voters->count() }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm btn-block mb-2" aria-label="Edit Voter"
                                        data-toggle="modal" data-target="#editVotersModal"
                                        data-id="{{ $candidate->id }}" data-name="{{ $candidate->name }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('candidate.destroy', $candidate->id) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm btn-block" aria-label="Delete Voter"
                                            onclick="return confirm('Rostandanham o\'chirmoqchimisiz')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Voters Modal -->
    <div class="modal fade" id="addVotersModal" tabindex="-1" aria-labelledby="addVotersModalLabel" aria-hidden="true"
        data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="addVotersModalLabel">Nomzod Qo'shish</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('candidate.store') }}" method="post" id="addVotersForm"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Ism</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Ismingizni kiriting" required>
                        </div>

                        <div class="form-group">
                            <label for="picture">Rasm</label>
                            <input type="file" class="form-control" id="picture" name="picture"
                                accept=".jpeg,.png,.jpg">
                            <small class="form-text text-muted">Profile rasm</small>
                        </div>

                        <div class="form-group">
                            <label for="resume">Resume</label>
                            <input type="file" class="form-control" id="resume" name="resume"
                                accept=".pdf,.doc,.docx">
                            <small class="form-text text-muted"> PDF resume</small>
                        </div>

                        <div class="form-group">
                            <label for="election_number">Saylov raqami</label>
                            <input type="number" class="form-control" id="election_number" name="election_number"
                                placeholder="Enter election number" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Orqaga</button>
                        <button type="submit" class="btn btn-success">Yaratish</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Voters Modal -->
    <div class="modal fade" id="editVotersModal" tabindex="-1" aria-labelledby="editVotersModalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="editVotersModalLabel">Edit Voters</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editVotersForm" method="POST" action="{{ route('candidate.update', $candidate->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Ism</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Ismingizni kiriting" required>
                        </div>

                        <div class="form-group">
                            <label for="picture">Rasm</label>
                            <input type="file" class="form-control" id="picture" name="picture"
                                accept=".jpeg,.png,.jpg">
                            <small class="form-text text-muted">Profile rasm</small>
                        </div>

                        <div class="form-group">
                            <label for="resume">Resume</label>
                            <input type="file" class="form-control" id="resume" name="resume"
                                accept=".pdf,.doc,.docx">
                            <small class="form-text text-muted"> PDF resume</small>
                        </div>

                        <div class="form-group">
                            <label for="election_number">Saylov raqami</label>
                            <input type="number" class="form-control" id="election_number" name="election_number"
                                placeholder="Enter election number" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Orqaga</button>
                        <button type="submit" class="btn btn-success">Yaratish</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-layout>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const editVotersModal = document.getElementById("editVotersModal");

        if (editVotersModal) {
            editVotersModal.addEventListener("show.bs.modal", function(event) {
                const button = event.relatedTarget; // Modalni ochishga sabab bo'lgan tugma
                const id = button.getAttribute("data-id"); // Tugmadan 'data-id' atributini olish
                console.log(editVotersModal);

                // `GET` so'rovini yuborish
                fetch(`/candidate/${id}/edit`, {
                        method: "GET",
                        headers: {
                            "Accept": "application/json",
                        },
                    })
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error("Error when fetching data.");
                        }
                        return response.json();
                    })
                    .then((data) => {
                        // Modal inputlarini to'ldirish
                        document.getElementById("name").value = data.name;
                        document.getElementById("election_number").value = data.election_number;

                        // Formani yangilash, agar kerak bo'lsa action ni yangilash
                        const editForm = document.getElementById("editVotersForm");
                        editForm.setAttribute("action", `/candidate/${id}`);
                    })
                    .catch((error) => {
                        alert(error.message); // Xatolik yuzaga kelsa
                    });
            });
        }

    });
    const fetchData = () => {
        fetch("/voter", {
                method: "GET",
                headers: {
                    "Accept": "application/json",
                },
            })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Error fetching voter status.");
                }
                return response.json();
            })
            .then((data) => {
                data.forEach((voter) => {
                    const statusElement = document.getElementById(`status-${voter.id}`);
                    if (statusElement) {
                        const statusHtml =
                            voter.status === "Voted" ?
                            '<span class="badge badge-success"><i class="fas fa-check-circle"></i> Voted</span>' :
                            '<span class="badge badge-danger"><i class="fas fa-times-circle"></i> Not Voted</span>';
                        statusElement.innerHTML = statusHtml;
                    }
                });
            })
            .catch((error) => {
                console.log(error.message);
            });
    };

    fetchData(); // Initial call
    setInterval(fetchData, 5000); // Repeat every 5 seconds
</script>
