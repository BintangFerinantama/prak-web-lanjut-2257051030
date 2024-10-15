<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
</head>
<body style="display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f0f8ff; margin: 0;">
    <div style="display: flex; flex-direction: column; align-items: center; width: 200px;">
        <!-- Gambar Profil -->
        <div style="border-radius: 50%; border: 2px solid #1e90ff; overflow: hidden; width: 100px; height: 100px;">
            <img src="https://via.placeholder.com/100" alt="Profile Image" style="width: 100%; height: 100%; object-fit: cover;">
        </div>

        <!-- Informasi Profil -->
        <div style="margin-top: 20px; width: 100%;">
            <div style="background-color: #1e90ff; color: white; text-align: center; padding: 10px; margin-top: 10px; border-radius: 5px;">
                <strong>Nama</strong><br>
                <?= $user->nama ?>
            </div>
            <div style="background-color: #87cefa; color: #fff; text-align: center; padding: 10px; margin-top: 10px; border-radius: 5px;">
                <strong>Kelas</strong><br>
                <?= $user->nama_kelas ?? 'Kelas tidak ditemukan' ?>
            </div>
            <div style="background-color: #1e90ff; color: white; text-align: center; padding: 10px; margin-top: 10px; border-radius: 5px;">
                <strong>NPM</strong><br>
                <?= $user->npm ?>
            </div>
        </div>
    </div>
</body>
</html>
