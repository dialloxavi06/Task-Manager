# 🗂️ Aufgaben-Manager mit PHP & SQLite/MySQL

Dieses Projekt ist ein einfacher Aufgaben-Manager, entwickelt in reinem PHP unter Beachtung der Prinzipien des MVC-Designmusters (Model-View-Controller). Ziel ist es, CRUD-Funktionalitäten (Erstellen, Lesen, Aktualisieren, Löschen) für Aufgaben bereitzustellen.

## 🔧 Technologien

- ✅ PHP (ohne Framework)
- ✅ MySQL
- ✅ Bootstrap (für das Frontend-Styling)
- ✅ HTML5/CSS3
- ✅ MVC-Architektur (einfach gehalten)

## 🚀 Installation

1. **Projekt klonen**:
   ```bash
   git clone https://github.com/username/Task-Manager.git
   cd Task-Manager

## 📁 Projektstruktur

Task-Manager ├── config/ │ └── Database.php 
### Datenbankverbindung ├── Controller/ │ └── TaskController.php 
### Logik für Aufgabenverwaltung ├── Entity/ │ └── Task.php 
### Aufgabenmodell ├── Repository/ │ └── TaskRepository.php 
### Datenbankoperationen für Aufgaben ├── public/ │ ├── index.php 
### Einstiegspunkt der Anwendung │ ├── create.php 
### Formular zum Erstellen einer Aufgabe │ ├── edit.php 
### Formular zum Bearbeiten einer Aufgabe │ └── delete.php 
### Logik zum Löschen einer Aufgabe ├── templates/ │ ├── header.php 
### Gemeinsames Header-Template │ ├── footer.php 
### Gemeinsames Footer-Template │ └── task_form.php 
### Formular für Aufgaben (Erstellen/Bearbeiten) ├── README.md 
### Dokumentation des Projekts └── test/
### Testdatei für die Anwendun

2. **Datenbank konfigurieren**:

    Öffnen Sie die Datei Database.php.
    Passen Sie die Konfigurationsparameter für SQLite oder MySQL an:
    ```php
    <?php
    $dsn = 'mysql:host=localhost;dbname=task_manager;charset=utf8';
    $username = 'root';
    $password = '';
    ```
