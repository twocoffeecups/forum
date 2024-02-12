<template>
    <!-- Text -->
    <div class="row mb-3">
        <div class="container">
            <h4>Content</h4>
            <p class="lead">
                An example 2-level sidebar with collasible menu items. The menu functions like an "accordion" where only
                a single
                menu is be open at a time. While the sidebar itself is not toggle-able, it does responsively shrink in
                width on smaller screens.</p>
        </div>
    </div>

    <!-- Card -->
    <div class="row mb-3">
        <div class="col-12 col-sm-12 col-md-6 col-lg-3">
            <div class="card text-bg-primary bg-gradient mb-3 col mx-auto" style="max-width: 360px; max-height: 145px;">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="col">
                            <h2>123</h2>
                            <span class="fst-italic">Forums</span>
                        </div>
                        <div class="col d-flex justify-content-center align-items-center">
                            <i class="fas fa-comments" style="font-size: 2.3em"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <p class="card-text text-center" role="button">More info <i class="fas fa-arrow-circle-right"></i>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-6 col-lg-3">
            <div class="card text-bg-secondary bg-gradient mb-3 col mx-auto" style="max-width: 360px; max-height: 145px;">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="col">
                            <h2>43</h2>
                            <span class="fst-italic">Users</span>
                        </div>
                        <div class="col d-flex justify-content-center align-items-center">
                            <i class="far fa-user" style="font-size: 2.3em"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <p class="card-text text-center" role="button">More info <i class="fas fa-arrow-circle-right"></i>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-6 col-lg-3">
            <div class="card text-bg-danger bg-gradient mb-3 col mx-auto" style="max-width: 360px; max-height: 145px;">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="col">
                            <h2>21</h2>
                            <span class="fst-italic">Reports</span>
                        </div>
                        <div class="col d-flex justify-content-center align-items-center">
                            <i class="far fa-flag" style="font-size: 2.3em"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <p class="card-text text-center" role="button">More info <i class="fas fa-arrow-circle-right"></i>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-6 col-lg-3">
            <div class="card text-bg-success bg-gradient mb-3 col mx-auto" style="max-width: 360px; max-height: 145px;">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="col">
                            <h2>14</h2>
                            <span class="fst-italic">Categories</span>
                        </div>
                        <div class="col d-flex justify-content-center align-items-center">
                            <i class="fas fa-tags" style="font-size: 2.3em"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <p class="card-text text-center" role="button">More info <i class="fas fa-arrow-circle-right"></i>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="row mb-3">
        <div class="container-fluid">
            <!-- Table card -->
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between my-2">
                        <h4>All users</h4>
                        <div>
                            <button class="btn btn-sm btn-success" title="Add new user">
                                <i class="fas fa-user-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mb-1">
                        <div
                            class="d-flex mt-2 flex-column flex-md-row flex-lg-row flex-xl-row justify-content-center justify-content-md-between justify-content-lg-between mb-3">
                            <div class="d-none d-md-flex d-lg-flex d-xl-flex my-2">
                                <span class="form-text">
                                    Show
                                </span>
                                <select class="form-select form-select-sm mx-2" aria-label="Select entries">
                                    <option value="10" selected>10</option>
                                    <option value="30">30</option>
                                    <option value="50">50</option>
                                </select>
                                <span class="form-text">entries</span>
                            </div>
                            <div class="d-flex mx-2 my-2">
                                <label class="form-text mx-1">Search: </label>
                                <input type="search" class="form-control" id="search" style="max-height: 20px;"/>
                            </div>
                        </div>

                        <!-- Table -->
                        <table class="table table-striped table-hover table-bordered">
                            <thead class="table-primary">
                            <tr></tr>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Login</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Status</th>
                                <th scope="col">Forums</th>
                                <th scope="col">Messages</th>
                                <th scope="col">Violations</th>
                                <th scope="col">Register date</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in 8">
                                    <th scope="row">1</th>
                                    <td>tot@H</td>
                                    <td>Tod Howard</td>
                                    <td>tot@gmail.com</td>
                                    <td>User</td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>36</td>
                                    <td>0</td>
                                    <td>08.09.2023</td>
                                    <td>
                                          <span role="button" class="text-primary mx-2" title="Edit">
                                            <i class="fas fa-edit"></i>
                                          </span>

                                        <span role="button" class="text-danger mx-2" title="Edit">
                                            <i class="fas fa-trash"></i>
                                          </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex flex-column flex-md-row flex-lg-row justify-content-between">
                        <div class="d-flex mt-1 d-none d-md-block d-lg-block d-xl-block align-items-center">
                            <div class="table-info" id="table-info" role="status" aria-live="polite">Showing 1 to 10 of
                                57
                                entries
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-1">
                            <nav>
                                <ul class="pagination" style="color: black">
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Предыдущая">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Следующая">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Main",
}
</script>

<style scoped>

</style>
