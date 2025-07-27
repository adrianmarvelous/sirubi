<div class="card p-3">
    <h1 class="text-center">List User</h1>
    <div class="table-responsive">
        <table class="table table-striped" id="example">
            <thead>
                <tr class="table-primary">
                    <td>No</td>
                    <td>Nama</td>
                    <td>E-Mail</td>
                    <td>Google Id</td>
                    <td>Role</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($users as $key => $value) {
                ?>
                <tr>
                    <td><?=$key+1?></td>
                    <td><?=$value['name']?></td>
                    <td><?=$value['email']?></td>
                    <td><?=$value['google_id']?></td>
                    <td>
                        <form action="controller/users.php" method="POST">
                            <input type="hidden" name="action" value="change_role">
                            <input type="hidden" name="id_user" value="<?= $value['id_user'] ?>">
                            <select name="role" class="form-select" id="role_select_<?= $key ?>"  onchange="if(confirm('Yakin ubah role?')) this.form.submit();">
                                <?php
                                    foreach ($role as $key_role => $value_role) {
                                        $selected = ($value['role'] == $value_role['role']) ? 'selected' : '';
                                        echo "<option value=\"{$value_role['id_role']}\" $selected>{$value_role['role']}</option>";
                                    }
                                ?>
                            </select>
                        </form>

                    </td>

                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>