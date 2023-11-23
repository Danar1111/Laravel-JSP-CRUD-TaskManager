<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Register</title>
    <style>
        .custom-container {
            height: 100vh;
        }

        .custom-background {
            background: url('http://taskmanager.danar.site/images/bg.jpg') no-repeat center center/cover;
            height: 100vh;
        }

        .glass {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0));
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 20px;
            border: solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        }
    </style>
</head>
<body>
    <div class="container-fluid custom-background">
        <div class="container d-flex justify-content-center align-items-center custom-container">
            <div class="px-5 py-5 mx-auto glass">
                <h2 class="mt-2 mb-4 text-center fw-bold">Register</h2>

                <form action="https://taskmanager.danar.site/create" method="POST">
                    <input type="hidden" name="_token" value="<%= request.getSession().getId() %>">
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="name" placeholder="Insert Name" value="${param.name}">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Insert Email" value="${param.email}">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Insert Password">
                    </div>

                    <input type="hidden" name="submit" value="true">

                    <button type="submit" class="btn btn-primary mb-3 mt-1">Register</button>
                </form>
                <p>Already have an account? <a href="https://taskmanager.danar.site/">Login</a></p>

                <div>

                    <br>
                
                    <p>Date: <%= new java.util.Date() %></p>
                
                    <p>Location: <%= request.getServerName() %></p>
                
                    <p>Time: <%= new java.text.SimpleDateFormat("HH:mm:ss").format(new java.util.Date()) %></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
