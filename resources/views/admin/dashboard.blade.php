<x-admin-component.dashboard>
    <x-admin-component.breadcrumbs class="mb-4" :links="['Dashboard' => route('admin.dashboard')]" />

    <x-card class="p-6">
        <h2 class="text-xl font-semibold mb-4">Dashboard Summary</h2>

        <div>
            <!-- Latest Jobs -->
            <div class="bg-white rounded-xl mb-8 shadow p-4 border border-gray-100">
                <h3 class="text-lg font-semibold mb-3 text-gray-800">📌 Latest Jobs</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead>
                            <tr class="bg-gray-50 text-gray-700">
                                <th class="px-4 py-2">Company</th>
                                <th class="px-4 py-2">Title</th>
                                <th class="px-4 py-2">Location</th>
                                <th class="px-4 py-2">Salary</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2">Google</td>
                                <td class="px-4 py-2">Frontend Developer</td>
                                <td class="px-4 py-2">New York</td>
                                <td class="px-4 py-2">15000</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2">Amazon</td>
                                <td class="px-4 py-2">Backend Developer</td>
                                <td class="px-4 py-2">New York</td>
                                <td class="px-4 py-2">15000</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2">Amazon</td>
                                <td class="px-4 py-2">Backend Developer</td>
                                <td class="px-4 py-2">New York</td>
                                <td class="px-4 py-2">15000</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2">Amazon</td>
                                <td class="px-4 py-2">Backend Developer</td>
                                <td class="px-4 py-2">New York</td>
                                <td class="px-4 py-2">15000</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2">Amazon</td>
                                <td class="px-4 py-2">Backend Developer</td>
                                <td class="px-4 py-2">New York</td>
                                <td class="px-4 py-2">15000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Latest Signups -->
            <div class="bg-white rounded-xl mb-8 shadow p-4 border border-gray-100">
                <h3 class="text-lg font-semibold mb-3 text-gray-800">👤 Latest Signups</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead>
                            <tr class="bg-gray-50 text-gray-700">
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Sign up At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2">John Doe</td>
                                <td class="px-4 py-2">john@example.com</td>
                                <td class="px-4 py-2">2 minutes ago</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2">Jane Smith</td>
                                <td class="px-4 py-2">jane@example.com</td>
                                <td class="px-4 py-2">5 hours ago</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2">Jane Smith</td>
                                <td class="px-4 py-2">jane@example.com</td>
                                <td class="px-4 py-2">5 hours ago</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2">Jane Smith</td>
                                <td class="px-4 py-2">jane@example.com</td>
                                <td class="px-4 py-2">5 hours ago</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2">Jane Smith</td>
                                <td class="px-4 py-2">jane@example.com</td>
                                <td class="px-4 py-2">5 hours ago</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Latest Applied -->
            <div class="bg-white rounded-xl mb-8 shadow p-4 border border-gray-100">
                <h3 class="text-lg font-semibold mb-3 text-gray-800">📝 Latest Applied</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead>
                            <tr class="bg-gray-50 text-gray-700">
                                <th class="px-4 py-2">Job</th>
                                <th class="px-4 py-2">User</th>
                                <th class="px-4 py-2">Expected Salary</th>
                                <th class="px-4 py-2">Satatus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2">UI Designer</td>
                                <td class="px-4 py-2">Ali Reza</td>
                                <td class="px-4 py-2">10000</td>
                                <td class="px-4 py-2">Approved</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2">DevOps Engineer</td>
                                <td class="px-4 py-2">Sara Ahmad</td>
                                <td class="px-4 py-2">10000</td>
                                <td class="px-4 py-2">pending</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2">DevOps Engineer</td>
                                <td class="px-4 py-2">Sara Ahmad</td>
                                <td class="px-4 py-2">10000</td>
                                <td class="px-4 py-2">pending</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2">DevOps Engineer</td>
                                <td class="px-4 py-2">Sara Ahmad</td>
                                <td class="px-4 py-2">10000</td>
                                <td class="px-4 py-2">pending</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2">DevOps Engineer</td>
                                <td class="px-4 py-2">Sara Ahmad</td>
                                <td class="px-4 py-2">10000</td>
                                <td class="px-4 py-2">pending</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </x-card>
</x-admin-component.dashboard>
