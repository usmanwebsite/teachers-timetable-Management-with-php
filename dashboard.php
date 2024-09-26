<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Static Variables */
        :root {
            --admin-header-height: 80px;
            --admin-footer-height: 40px;
            --admin-nav-width: 300px;
            --bg-color: #e5e5e5;
            --bcn-orange: #f16a2d;
            --bcn-orange-light: #f9ae56;
            --bcn-orange-dark: #d96129;
            --black: #333;
            --white: #f5f5f5;
            --text-color: #555;
            --border-color: rgb(238,238,238);
            --border-style: 1px solid var(--border-color);
            --spacing: 1rem;
            --column-count: 2;
        }

        /* Global CSS */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            height: 100%;
            overflow-x: hidden;
        }

        /* Main Layout Grid */
        .admin {
            display: grid;
            height: 100vh;
            grid-template-rows: var(--admin-header-height) 1fr var(--admin-footer-height);
            grid-template-columns: var(--admin-nav-width) 1fr;
            grid-template-areas:
                "header header"
                "nav    main"
                "footer footer";
        }

        .admin__header {
            display: flex;
            grid-area: header;
            height: var(--admin-header-height);
            background-color: #fff;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16);
            position: relative;
        }

        .admin__nav {
            grid-area: nav;
            background-color: #313541;
        }

        .admin__main {
            grid-area: main;
            padding: var(--spacing);
            overflow-y: auto;
            overflow-x: hidden;
            -webkit-overflow-scrolling: touch;
            background-color: var(--bg-color);
        }

        .admin__footer {
            display: flex;
            grid-area: footer;
            justify-content: space-between;
            align-items: center;
            height: var(--admin-footer-height);
            padding: 0 var(--spacing);
            color: #4e5561;
            background-color: #1d2127;
        }

        @media screen and (min-width: 48rem) {
            :root {
                --spacing: 2rem;
                --column-count: 4;
            }
        }

        /* Dashboard Overview Grid */
        .dashboard {
            display: grid;
            grid-template-columns: repeat(var(--column-count), 1fr);
            gap: var(--spacing);
        }

        .dashboard__item {
            grid-column-end: span 2;
            padding: calc(var(--spacing) / 2);
        }

        .dashboard__item--full {
            grid-column: 1 / -1;
        }

        .dashboard__item--col {
            grid-column-end: span 1;
        }

        /* Demo stuff to make it look nice */
        a {
            color: #dc5a60;
            text-decoration: none;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .logo {
            display: flex;
            height: var(--admin-header-height);
            justify-content: center;
            align-items: center;
            background-color: var(--bcn-orange);
            font-size: 1rem;
            color: #fff;
        }

        .logo h1 {
            margin: 0;
        }

        .toolbar {
            display: flex;
            flex: 1;
            justify-content: space-between;
            align-items: center;
            padding: 0 var(--spacing);
        }

        .menu {
            list-style-type: none;
            padding: 0;
        }

        .menu__title {
            display: block;
            padding: 2rem 2rem .5rem;
            color: #76808f;
            font-weight: 700;
        }

        .menu__link {
            display: block;
            padding: 10px 30px;
            color: #76808f;
            text-decoration: none;
        }

        .menu__link.is-active {
            color: #fff;
            background-color: var(--bcn-orange-dark);
            border-left: 3px solid var(--bcn-orange);
        }

        .menu__link:hover,
        .menu__link:focus {
            color: currentColor;
            background-color: var(--bcn-orange-light);
        }

        .card {
            height: 100%;
            font-weight: 300;
            background-color: #fff;
            border: 1px solid #e6eaee;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .card__header {
            padding: 20px 30px;
            border-bottom: 1px solid #e6eaee;
            font-weight: 700;
        }

        .card__item {
            padding: 20px 30px;
        }

        .btn {
            display: inline-block;
            border-radius: 5em;
            border: 0;
            padding: 0.5rem 1rem;
            white-space: nowrap;
        }

        .btn--primary {
            color: #fff;
            background-color: #56bf89;
        }
    </style>
</head>
<body>
    <div class="admin">
        <header class="admin__header">
            <a href="#" class="logo">
                <h1>Dashboard</h1>
            </a>
            <div class="toolbar">
                <div class="toolbar__left">
                    <a href="classroom_form.php"><button class="btn btn--primary">Add Classroom</button> </a>
                    
                </div>
                <div class="toolbar__right">
                    <a href="#" class="btn btn--primary logout">Log Out</a>
                </div>
            </div>
        </header>
        <nav class="admin__nav">
            <ul class="menu">
                <li class="menu__title">Dashboard</li>
                <li class="menu__item">
                    <a class="menu__link" href="index.php">Import Excel Sheet</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="fetch.php">Fetch Excel data</a>
                </li>
                <li class="menu__title">Content</li>
                <li class="menu__item">
                    <a class="menu__link" href="classroom_form.php">Add Classrooms</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="teacher_form.php">Add Teachers</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link is-active" href="time_form.php">Add Time_slots</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="Department_timetable_form.php">Add department_timetables</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="generate_timetable.php">Exact Teacher</a>
                </li>
                <li class="menu__title">Display Data</li>
                <li class="menu__item">
                    <a class="menu__link" href="fetch_classroom.php">Fetch Classroom</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="fetch_teacher.php">Fetch Teacher</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="fetch_time.php">Fetch Time_slots</a>
                </li>
                <li class="menu__title">Timetables</li>
                <li class="menu__item">
                    <a class="menu__link" href="teacherwise_table.php">Teacherwise Timetable</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="roomwise_table.php">Roomwise Timetable</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="classwise_table.php">Classroomwise Timetable</a>
                </li>
                <li class="menu__title">Help</li>
                <li class="menu__item">
                    <a class="menu__link" href="#">Documentation</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="#">Changelogs</a>
                </li>
            </ul>
        </nav>
        <main class="admin__main">
            <div class="dashboard">
                <div class="dashboard__item">
                    <div class="card">
                        <div class="card__header">
                            Teaacher
                        </div>
                        <div class="card__content">
                            <div class="card__item">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae ab libero consectetur et numquam a id. Dignissimos nesciunt aperiam ut minima itaque repudiandae architecto praesentium autem. Porro ad labore fugiat?
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dashboard__item dashboard__item--col">
                    <div class="card">
                        <div class="card__header">
                            Classroom
                        </div>
                        <div class="card__content">
                            <div class="card__item">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium labore id culpa sit nisi nostrum, excepturi cumque eos laborum ducimus alias, provident doloribus et facere explicabo ab repudiandae perferendis earum.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dashboard__item dashboard__item--col">
                    <div class="card">
                        <div class="card__header">
                            Time_slots
                        </div>
                        <div class="card__content">
                            <div class="card__item">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium labore id culpa sit nisi nostrum, excepturi cumque eos laborum ducimus alias, provident doloribus et facere explicabo ab repudiandae perferendis earum.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dashboard__item dashboard__item--full">
                    <div class="card">
                        <div class="card__header">
                            Recent log entries
                        </div>
                        <div class="card__content">
                            <div class="card__item">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab corporis maiores, aliquid aut maxime saepe suscipit, pariatur quae harum ratione dolor itaque hic velit fugiat, amet dignissimos! Adipisci, libero dignissimos!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="admin__footer">
            <div class="admin__footer-left">
                This is the footer-left
            </div>
            <div class="admin__footer-right">
                This is the footer-right
            </div>
        </footer>
    </div>
</body>
</html>

