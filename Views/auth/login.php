<style>
    .cx{
        max-width:500px;
        margin:auto;
        padding:25px;
    }
    .card {
        box-shadow : 0px 0px 10px rgba(0,0,0,.2);
        border-radius:10px;
        background:#f2f2f2;
        padding:25px;
    }
    .form {
        width:100%;
        display:flex;
        gap:10px;
    }
    input {
        width:100%;
        padding:5px;
        border:1px solid #444;
        border-radius:5px;
        gap:20px;
        margin-bottom:20px;
    }
    .btn-primary {
        padding:7px;
        border-radius:10px;
        padding-left:35px;
        padding-right:35px;
        color:white;
        background:#666;
        border:none;
        margin:auto;
        display:block;
    }
    .text-center {
        display:block;
        text-align:center;
    }
</style>

<div class="cx mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Login to Babaju</h2>
                </div>
                <div class="card-body">
                    <form action="<?= BASEURL ?>/?page=login_proses" method="POST">
                            <?php if (!empty($error)): ?>
                                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                            <?php endif; ?>

                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">

                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" 
                                        value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>