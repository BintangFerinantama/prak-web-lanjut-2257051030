<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f4f4f4; margin: 0;">
    <div style="display: flex; flex-direction: column; align-items: center; width: 200px;">
        <!-- Gambar Profil -->
        <div style="border-radius: 50%; border: 2px solid #ccc; overflow: hidden; width: 100px; height: 100px;">
            <img src="https://via.placeholder.com/100" alt="Profile Image" style="width: 100%; height: 100%; object-fit: cover;">
        </div>

        <!-- Informasi Profil -->
        <div style="margin-top: 20px; width: 100%;">
            <div style="background-color: #e0e0e0; text-align: center; padding: 10px; margin-top: 10px; border-radius: 5px;">
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><?= $nama ?></td>
            </tr>
            </div>
            <div style="background-color: #e0e0e0; text-align: center; padding: 10px; margin-top: 10px; border-radius: 5px;">
            <tr>
                <td>Kelas</td>
                <td>:</td>
                <td><?= $kelas ?></td>
            </tr>
            </div>
            <div style="background-color: #e0e0e0; text-align: center; padding: 10px; margin-top: 10px; border-radius: 5px;">
            <tr>
                <td>NPM</td>
                <td>:</td>
                <td><?= $npm ?></td>
            </tr>
            </div>
        </div>
    </div>
</body>
</html>