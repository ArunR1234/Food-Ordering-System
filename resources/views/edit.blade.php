@extends('admintemplate')
@section('title', 'Edit Chef')

@section('content')
    <style>
        .form-container {
            max-width: 500px;
            margin: 40px auto;
            background: #111;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 2px 12px rgba(255, 215, 0, 0.2);
            color: #e0e0e0;
        }

        h2 {
            color: #FFD700;
            text-align: center;
            margin-bottom: 20px;
            font-family: 'Great Vibes', cursive;
            font-size: 2rem;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
        }

        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: none;
            background: #222;
            color: #fff;
        }

        img.chef-img-preview {
            border-radius: 8px;
            margin-bottom: 10px;
            border: 1px solid #FFD700;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }

        button.update-btn {
            padding: 12px 25px;
            border-radius: 25px;
            border: none;
            background: #FFD700;
            color: #111;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button.update-btn:hover {
            background: #e6b347;
            box-shadow: 0 2px 8px rgba(255, 215, 0, 0.3);
        }

        a.back-btn {
            padding: 12px 25px;
            border-radius: 25px;
            text-decoration: none;
            background: #555;
            color: #fff;
            font-weight: 600;
            text-align: center;
            transition: all 0.3s ease;
        }

        a.back-btn:hover {
            background: #777;
            box-shadow: 0 2px 8px rgba(255, 255, 255, 0.2);
        }
    </style>

    <div class="form-container">
        <h2>Edit Chef</h2>

        <form action="{{ route('admin.chefs.update', $chef->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ $chef->name }}">

            <label for="role">Role</label>
            <input type="text" name="role" id="role" value="{{ $chef->role }}">

            <label>Current Image</label>
            @if ($chef->image)
                <img src="{{ asset('images/chefs/' . $chef->image) }}" width="80" class="chef-img-preview">
            @else
                <p>No image available</p>
            @endif

            <label for="image">New Image (optional)</label>
            <input type="file" name="image" id="image" accept="image/*">

            <div class="btn-container">
                <button type="submit" class="update-btn">Update Chef</button>
                <a href="{{ route('admin.chefs.index') }}" class="back-btn">Back</a>
            </div>
        </form>
    </div>

    <script>
        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    </script>
@endsection
