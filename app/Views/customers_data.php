<?php
                        if (count($customers) > 0) {
                            $count = 1;
                            foreach ($customers as $customer) {
                        ?>
                                <tr>
                                    <th scope="row"><?php echo $count ?></th>
                                    <td><?php echo $customer['name'] ?></td>
                                    <td><?php echo $customer['email'] ?></td>
                                    <td><?php echo $customer['mobile'] ?></td>
                                    <td><?php if ($customer['status'] == 1) {
                                            echo "Active";
                                        } else {
                                            echo "InActive";
                                        } ?></td>
                                </tr>
                            <?php $count++;
                            }
                        } else { ?>
                            <tr>
                                <td colspan='5'>
                                    No record found.
                                </td>
                            </tr>
                        <?php } ?>