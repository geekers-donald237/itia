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
            <h2>Liste des Clients et Assurances</h2>
            <!-- ... (autre contenu) ... -->

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th> <!-- Nouvelle colonne pour les actions -->
                </tr>
                </thead>
                <tbody>
                @foreach($clients as $client)
                    <tr>
                        <td>{{ $client->nom }}</td>
                        <td>{{ $client->prenom }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->address }}</td>
                        <td>
                            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary btn-sm">Modifier</a>
                            <form action="{{ route('clients.destroy', $client->id) }}" method="post" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client?')">Supprimer</button>
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
        <div class="col-md-6">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajouterClientModal">
                Ajouter un Client
            </button>
        </div>
        <div class="col-md-6 text-right">
            <a type="button" href="{{route('assurance.index')}}" class="btn btn-success" >
                Voir la Liste des Assurances
            </a>
        </div>
    </div>
</div>

<!-- Modal pour ajouter un client -->
<div class="modal fade" id="ajouterClientModal" tabindex="-1" role="dialog" aria-labelledby="ajouterClientModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ajouterClientModalLabel">Ajouter un Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('clients.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="nom">Nom:</label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom"
                               required>
                        @error('nom')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom:</label>
                        <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenom"
                               name="prenom" required>
                        @error('prenom')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                               name="email" required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                               name="address" required>
                        @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Ajoutez d'autres champs selon votre table -->
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
