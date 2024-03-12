<?php
if (isset($_SESSION['user_id'])) {
    echo '<header>
            <h1>Gallery</h1>
            <div>
            <a href="/public">Home</a>
            <a href="/public/upload">Upload</a>
            <a href="/public/remembered">Remembered</a>
            <a href="/public/logout">Logout</a>
            </div>
        </header>';
}
else {
    echo '<header>
            <h1>Gallery</h1>
            <div>
            <a href="/public">Home</a>
            <a href="/public/upload">Upload</a>
            <a href="/public/login">Login</a>
            <a href="/public/register">Register</a>
            </div>
        </header>';
}