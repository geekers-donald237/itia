<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to INTIA</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-12">
            <h2>Liste des  Assurances</h2>
            <!-- ... (autre contenu) ... -->

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Type</th>
                    <th>Montant</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                    <th>Client</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($assurances as $assurance)
                    <tr>
                        <td>{{ $assurance->type }}</td>
                        <td>{{ $assurance->montant }}</td>
                        <td>{{ $assurance->date_debut }}</td>
                        <td>{{ $assurance->date_fin }}</td>
                        <td>{{ $assurance->user_id ?? 'aucun client associe'}}</td>
                        <td>
                            <a href="{{ route('assurance.edit', $assurance->id) }}" class="btn btn-primary btn-sm">Modifier</a>
                            <form action="{{ route('assurance.destroy', $assurance->id) }}" method="post" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette assurance?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <!-- ... (autre contenu) ... -->


        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12 text-right">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ajouterAssuranceModal">
                Ajouter une Assurance
            </button>
        </div>
    </div>
</div>

<div class="modal fade" id="ajouterAssuranceModal" tabindex="-1" role="dialog" aria-labelledby="ajouterAssuranceModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ajouterAssuranceModalLabel">Ajouter une Assurance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('assurance.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="type">Type:</label>
                        <input type="text" class="form-control" id="type" name="type" required>
                    </div>
                    <div class="form-group">
                        <label for="montant">Montant:</label>
                        <input type="number" class="form-control" id="montant" name="montant" required>
                    </div>
                    <div class="form-group">
                        <label for="date_debut">Date début:</label>
                        <input type="date" class="form-control" id="date_debut" name="date_debut" required>
                    </div>
                    <div class="form-group">
                        <label for="date_fin">Date fin:</label>
                        <input type="date" class="form-control" id="date_fin" name="date_fin" required>
                    </div>
                    <div class="form-group">
                        <label for="client_id">Client:</label>
                        <select class="form-control" id="client_id" name="client_id">
                            <option value="">Sélectionner un client</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->nom }} {{ $client->prenom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
