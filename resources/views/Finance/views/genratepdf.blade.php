<style>
    table{width: 100%;}
table,tr,td,th {
    border:solid 1px black;
    border-collapse: collapse;
    text-align: center;
}
</style>
                        <table>
                            <thead>
                                <tr>
                                    <th colspan="6"> <h3><?=$data['title'].' <small>(From : '.$data['fromdate'].' To :'.$data['todate'].')</small>'?></h3></th>
                                </tr>
                                <tr>
                                    <th>
                                        Account Id <br>
                                        Name of Account
                                    </th> 
                                    <th>Date</th>
                                    <th>References</th>
                                    <!--<th>Trans Description</th>-->
                                    <th>Debit Amt</th>
                                    <th>Credit Amt</th>
                                    <th>Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($Accounts as $Account)
                                        <?php $Account->runningbalance = 0; ?>
                                <tr>
                                    <td rowspan="{{count($Account->data)+1}}">
                                        <p>{{$Account->AccountId}}</p>
                                        <p>{{$Account->CategoryName}}</p>
                                    </td>
                                    <td><p>{{$Account->data[0]->date}}</p></td>
                                    <td style="text-align: left;"><p>{{$Account->data[0]->refrance}}</p></td>
                                    <td><p>{{$Account->data[0]->debit}}</p>
                                    </td>
                                    <td>
                                        <p>{{$Account->data[0]->credit}}</p>
                                    </td> 
                                    <td>
                                        <?php $Account->data[0]->runningbalance =  $Account->runningbalance += $Account->data[0]->debit - $Account->data[0]->credit; ?>
                                        <p>{{$Account->data[0]->runningbalance}}</p>
                                    </td>
                                </tr>
                                    @foreach($Account->data as $K=>$E)
                                    <?php if($K){?>
                                    <tr>
                                    <td><p>{{$E->date}}</p></td>
                                    <td style="text-align: left;"><p>{{$E->refrance}}</p></td>
                                    <!--<td><p>{{$E->description}}</p></td>-->
                                    <td><p>{{$E->debit}}</p>
                                    </td>
                                    <td>
                                        <p>{{$E->credit}}</p>
                                    </td> 
                                    <td>
                                        <?php $E->runningbalance =  $Account->runningbalance += $E->debit - $E->credit; ?>
                                        <p>{{$E->runningbalance}}</p>
                                    </td>
                                </tr>
                                    <?php } ?>
                                    @endforeach
                                <tr>
                                    <td colspan="2">Total</td>
                                        <td><p>{{$Account->debitTotal}}</p></td>
                                        <td><p>{{$Account->CreditTotal}}</p></td> 
                                        <td><p>{{$Account->runningbalance}}</p></td> 
                                </tr>
                                @endforeach
                            </tbody>
                        </table>