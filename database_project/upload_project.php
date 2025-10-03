<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Project</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #F7F9FB; padding: 20px; }
        .form-container { max-width: 500px; margin: auto; background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        h2 { text-align: center; color: #333; }
        label { font-weight: bold; margin-top: 10px; display: block; }
        input, textarea, button { width: 100%; padding: 10px; margin-top: 5px; }
        button { background-color: #007BFF; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Upload Your Project</h2>
        <form action="store_project.php" method="post" enctype="multipart/form-data">
            <label for="name">Your Name</label>
            <input type="text" id="name" name="name" required>
            
            <label for="project_name">Project Name</label>
            <input type="text" id="project_name" name="project_name" required>
            
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            
            <label for="description">Project Description</label>
            <textarea id="description" name="description" rows="4" required></textarea>
            
            <label for="resume">Upload Resume (PDF)</label>
            <input type="file" id="resume" name="resume" accept=".pdf">
            
            <label for="project_files"> Upload Project Files </label>
            <input type="file" id="project_files" name="project_files[]" multiple accept=".html, .css, .js">
            
            <button type="submit" name="submit">Upload Project</button>
        </form>
    </div>
</body>
</html>
