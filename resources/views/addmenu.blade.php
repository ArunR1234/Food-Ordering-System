@extends('admintemplate')
@section('title', 'Add Menu')

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
        input[type="number"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: none;
            background: #222;
            color: #fff;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }

        button.submit-btn {
            padding: 12px 25px;
            border-radius: 25px;
            border: none;
            background: #FFD700;
            color: #111;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button.submit-btn:hover {
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
        <h2>Add New Menu</h2>

        <form action="{{ route('menustore') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="name">Menu Name</label>
            <input type="text" name="name" id="name" placeholder="Enter menu name">

            <label for="price">Price (₹)</label>
            <input type="number" name="price" id="price" placeholder="Enter price" step="0.01">

            <label for="image">Menu Image</label>
            <input type="file" name="image" id="image">

            <div class="btn-container">
                <button type="submit" class="submit-btn">Add Menu</button>
                <a href="{{ route('menulist') }}" class="back-btn">Back</a>
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
