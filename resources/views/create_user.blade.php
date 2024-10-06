<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <style>
        /* Warna latar belakang biru muda */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff; /* light blue */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Container utama untuk form */
        form {
            background-color: #ffffff; /* warna putih */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* bayangan halus */
            padding: 40px;
            max-width: 400px;
            width: 100%;
        }

        h2 {
            text-align: center;
            color: #0073e6; /* warna biru gelap */
            font-size: 24px;
            margin-bottom: 20px;
        }

        label {
            color: #333; /* warna teks gelap */
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 2px solid #0073e6; /* border biru */
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #0073e6; /* warna biru */
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #005bb5; /* warna biru lebih gelap saat hover */
        }

        /* Styling untuk label dan input form agar rapi */
        label, input {
            display: block;
        }

        /* Margin dan spacing antar elemen */
        input {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <form action="{{ route('user.store') }}" method="POST">
        <h2>Create User</h2>
        @csrf
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required>

        <label for="npm">NPM:</label>
        <input type="text" id="npm" name="npm" required>

        <label for="kelas">Kelas:</label>
        <input type="text" id="kelas" name="kelas" required>

        <input type="submit" value="Submit">
    </form>
</body>

</html>
