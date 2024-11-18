<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header("Location: index.php");
    exit;
}

$file = 'agenda.txt';

function readContacts($file) {
    if (!file_exists($file)) {
        return [];
    }
    $contents = file($file, FILE_IGNORE_NEW_LINES);
    $contacts = [];
    foreach ($contents as $line) {
        list($name, $phone) = explode(',', $line);
        $contacts[] = ['name' => $name, 'phone' => $phone];
    }
    return $contacts;
}

function writeContacts($file, $contacts) {
    $data = '';
    foreach ($contacts as $contact) {
        $data .= "{$contact['name']},{$contact['phone']}\n";
    }
    file_put_contents($file, $data);
}

// Adicionar um novo contato
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_GET['edit'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $contacts = readContacts($file);
    $contacts[] = ['name' => $name, 'phone' => $phone];
    writeContacts($file, $contacts);
}

// Editar um contato
if (isset($_GET['edit'])) {
    $index = $_GET['edit'];
    $contacts = readContacts($file);
    $edit_contact = $contacts[$index];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $new_name = $_POST['name'];
        $new_phone = $_POST['phone'];
        $contacts[$index] = ['name' => $new_name, 'phone' => $new_phone];
        writeContacts($file, $contacts);
        header("Location: agenda.php");
        exit;
    }
}

// Excluir um contato
if (isset($_GET['delete'])) {
    $index = $_GET['delete'];
    $contacts = readContacts($file);
    unset($contacts[$index]);
    writeContacts($file, array_values($contacts));
    header("Location: agenda.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Agenda de Contatos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .container {
            width: 600px;
            padding: 20px;
            border-radius: 8px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2, h3 {
            color: #333;
            margin-bottom: 20px;
        }
        form input, form button {
            width: calc(50% - 10px);
            padding: 10px;
            margin: 5px 5px 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        form button {
            background-color: #7FA8DF;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
        form button:hover {
            background-color: #7FA8DF;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color:#7FA8DF;
            color: white;
        }
        .delete-button, .edit-button {
            color: red;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
        }
        .edit-button {
            color: #4CAF50;
            margin-left: 10px;
        }
        .logout {
            display: block;
            text-align: right;
            margin-top: 10px;
            color: #333;
            font-weight: bold;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Agenda de Contatos</h2>
        
        <a href="logout.php" class="logout">Sair</a>
        
        <h3>Adicionar Contato</h3>
        <form method="POST" action="">
            <input type="text" name="name" placeholder="Nome" required>
            <input type="text" name="phone" placeholder="Telefone" required>
            <button type="submit">Adicionar</button>
        </form>

        <?php if (isset($_GET['edit'])): ?>
            <h3>Editar Contato</h3>
            <form method="POST" action="">
                <input type="text" name="name" value="<?= htmlspecialchars($edit_contact['name']) ?>" required>
                <input type="text" name="phone" value="<?= htmlspecialchars($edit_contact['phone']) ?>" required>
                <button type="submit">Salvar Alterações</button>
            </form>
        <?php endif; ?>

        <h3>Lista de Contatos</h3>
        <table>
            <tr>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
            <?php
            $contacts = readContacts($file);
            foreach ($contacts as $index => $contact) {
                echo "<tr>";
                echo "<td>{$contact['name']}</td>";
                echo "<td>{$contact['phone']}</td>";
                echo "<td>
                        <a href='?edit=$index' class='edit-button'><img src='img/editar.png' alt='Editar'></a> 
                        <a href='?delete=$index' class='delete-button'><img src='img/excluir.png' alt='Excluir'>  </a>
                    </td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>