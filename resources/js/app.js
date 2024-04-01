import './bootstrap';
import 'flowbite';
import {toFormData} from "axios";

document.addEventListener("DOMContentLoaded", () => {
    addCurrency()
    setCurrency()
});


document.addEventListener("DOMContentLoaded",function (){
    fetch('/data')
        .then(response => response.json())
        .then(data => {
            let jsonString = JSON.stringify(data);
            localStorage.setItem('responseData', jsonString); //сохранение JSON из БД
        })
        .catch(error => {
            console.error('Ошибка:', error);
        });
})

let storedData = localStorage.getItem('responseData');
let parsedData;
if(storedData){
    parsedData= JSON.parse(storedData)
}

document.addEventListener("click", function (event){ //обработка изменений формы
    if (event.target.tagName =='INPUT' || event.target.tagName =='SELECT'){
        //обработка клика по выбору валюты
        if (event.target.id=="indexed_by"){
            let optionToSelect = event.target.options[event.target.value];
            optionToSelect.selected = true;
            document.getElementById('label_equivalent').textContent="Эквивалент кредита, взятого банком в " + event.target.options[event.target.options.selectedIndex].textContent
            document.getElementById('label_exchange').textContent="Курс покупки "+event.target.options[event.target.options.selectedIndex].textContent+" банком в месяц предоставления кредита"
            setCurrency()
            setExchangeRate(event.target.options[event.target.options.selectedIndex].textContent, parsedData, document.getElementById("date").value)
            setEquivalent()
        }

    }

})

document.addEventListener('input', function (event){ //заполнение полей таблиц при вводе суммы кредита
    if (event.target.id == "amount"){
        let amount=document.getElementById('amount')
        let cellCreditAmount=document.querySelectorAll("[data-content='credit_amount']")
        for (let cellCreditAmountElement of cellCreditAmount) {
            cellCreditAmountElement.textContent=amount.value
        }
        setEquivalent()
    }
})

document.addEventListener('change', function (event){
    if (event.target.id=="date"){
        //если есть льготный период
         setExchangeRate(getCurrency(), parsedData, event.target.value)
         setEquivalent()
    }
    else if(event.target.id=="half_spread_value"){
        setExchangeRate(getCurrency(), parsedData, document.getElementById("date").value)
    }
})

document.addEventListener('click', function (event){
    if(event.target.id=="calculate"){
        calculate()
    }
})



function getInterestRate(date){ // выбор ставки LIBOR CHF на дату
    let parseData=JSON.parse(storedData)["interest_rates"]
    for (let i=0; i<parseData.length;i++) {
        if (i>=1&&i<parseData.length-1){
            if (new Date(parseData[i-1]["date"]) < new Date (date).setDate(1) && new Date (date).setDate(1) < new Date(parseData[i+1]["date"])){
                return parseData[i]["CHF"]
            }
        }
    }
}

function addCurrency(selected=0) {//заполнение выбора валюты из JSON
    let select = document.getElementById ("indexed_by")
    while (select.firstChild) {
        select.removeChild (select.firstChild);
    }
    let index_currency = JSON.parse (storedData)['currency_index'];
    for (let i=0; i<index_currency.length; i++){
        var option = document.createElement ("option");
        option.text = index_currency[i]["currency"];
        option.value = i;
        select.appendChild (option);
    }
    let optionToSelect = select.options[selected];
    optionToSelect.selected = true;
}

function setCurrency(){ // заполнение выбраной валютой полей таблицы
    let currencyDefault = document.getElementById('indexed_by')
    for (let i=0; i<currencyDefault.options.length; i++){
        if (currencyDefault.options[i].selected==true){
            let currency =document.querySelectorAll("[data-content='currency']")
            for (let targetElement of currency ) {
                targetElement.textContent=currencyDefault.options[i].textContent
            }
            setExchangeRate(currencyDefault.options[i].textContent, JSON.parse(storedData))
        }
    }
}

function getCurrency(){
   let select = document.getElementById("indexed_by")
    for (let i=0; i< select.options.length;i++){
        if (select.options[i].selected==true){
            return select.options[i].textContent
        }
    }
}

function setEquivalent(){
    let amount=document.getElementById('amount').value
    let exchangeRate=document.getElementById("exchange_rate_of_CHF").value
    if (amount!=0&&exchangeRate!=0){
        document.getElementById("equivalent_in_CHF").value=(amount/exchangeRate).toFixed(2)
    }
}

function setExchangeRate(currency, data_array, date=false){
    if (date!=0){
        for (let i=1; i<data_array["average_montly"].length; i++){
            if (new Date(data_array["average_montly"][i]["date"]).setDate(1)==new Date (date).setDate(1)){

                document.getElementById("exchange_rate_of_CHF").value=data_array["average_montly"][i][currency]*((document.getElementById('half_spread_value').value) ? 1-document.getElementById('half_spread_value').value/100:1)
            }
        }
    }
    else{
        document.getElementById("exchange_rate_of_CHF").value=data_array["average_montly"][1][currency]*((!document.getElementById('half_spread_value').value) ? 1-document.getElementById('half_spread_value').value/100:1)
    }
}

function pmt(ratePerPeriod, numberOfPayments, presentValue, futureValue, type) {
    futureValue = typeof futureValue !== 'undefined' ? futureValue : 0;
    type = typeof type !== 'undefined' ? type : 0;
    if (ratePerPeriod != 0.0) {
        var q = Math.pow(1 + ratePerPeriod, numberOfPayments);
        return -(ratePerPeriod * (futureValue + (q * presentValue))) / ((-1 + q) * (1 + ratePerPeriod * (type)));
    } else if (numberOfPayments != 0.0) {
        return -(futureValue + presentValue) / numberOfPayments;
    }
    return 0;
}




function calculate(){
    let investment_period = parseInt(document.getElementById('investment_period').value)
    let gracePeriod = (document.getElementById('grace_period').value!=='')?parseInt(document.getElementById('grace_period').value):0
    let sumTotalInstallment=0  //Rata całościowa
    let interestInstallment=0
    let totalInstallment=0
    let equivalent = parseFloat(document.getElementById("equivalent_in_CHF").value)
    let amount = parseFloat(document.getElementById("amount").value)
    let baseRates =parsedData["interest_rates"]
    let exchange_rate = parsedData["average_montly"]
    let pko=parsedData["pko"]
    let inflation=parsedData["inflation"]
    let dateOfLoanRepayment=(document.getElementById("date_of_loan_repayment").value!=='')?new Date(document.getElementById("date_of_loan_repayment").value):false
    if(dateOfLoanRepayment){
        dateOfLoanRepayment.setMonth(dateOfLoanRepayment.getMonth()-1)
    }

    const spred=(document.getElementById("half_spread_value").value!=='')?parseFloat(document.getElementById("half_spread_value").value):0
    let dateStart = new Date (document.getElementById("date").value)
    //смещение расчетов выплат на месяц от даты выдачи
    dateStart.setDate(1)
    let currentMonth=new Date (dateStart)
    let settlementDate=new Date (dateStart.setDate(1))
        settlementDate.setMonth(dateStart.getMonth()+1)
    let currency = getCurrency()
    let currency_debt = equivalent
    let debt=amount

    let pmtInCurrency = 0
    let debtNBP=0
    let wibor3M_PLN=0
    let marginFromContract
    let pmtCounter=investment_period
    let inflationsRateOnDate=0

    let resArray = []
    let monthResArray = {}
    if (equivalent && amount){
        let baseRateOnDate=0;
        for (let j=0; j<exchange_rate.length; j++){ // получение курса обмена на каждый месяц
            let date=new Date (exchange_rate[j]["date"])
            if (date.getMonth() === settlementDate.getMonth() && date.getFullYear() === settlementDate.getFullYear()){
                debtNBP=amount/parseFloat(exchange_rate[j-1][currency])
                break
            }
            else{
                debtNBP=amount/parseFloat(exchange_rate[exchange_rate.length-1][currency])
            }
        }
        for (let i=0; i<pko.length;i++){
            let date=new Date (pko[i]["date"])
            if (date.getMonth() === dateStart.getMonth() && date.getFullYear() === dateStart.getFullYear()){
                marginFromContract=parseFloat(pko[i]["pko"])
                break
            }
            else{
                marginFromContract=parseFloat(pko[pko.length-1]["pko"])
            }
        }
        for (let i=1, period=1, gracePeriodCaunter=gracePeriod; i<=investment_period; i++, period++, pmtCounter--, gracePeriodCaunter--){
            let sales_rate_by_bank=0;
            for (let j=0; j<baseRates.length; j++){ // получение базовой ставки на каждый месяц
                let date=new Date (baseRates[j]["date"])
                if (date.getMonth() === settlementDate.getMonth() && date.getFullYear() === settlementDate.getFullYear()){
                    let month=settlementDate.getMonth()+1
                    monthResArray.date=settlementDate.getFullYear()+"-"+month+"-"+settlementDate.getDate()
                    baseRateOnDate=parseFloat(baseRates[j][currency])
                    wibor3M_PLN=parseFloat(baseRates[j]["PLN"])
                    break
                }
                else{
                    let month=settlementDate.getMonth()+1
                    monthResArray.date=settlementDate.getFullYear()+"-"+month+"-"+settlementDate.getDate()
                    baseRateOnDate=parseFloat(baseRates[baseRates.length-1][currency])
                    wibor3M_PLN=parseFloat(baseRates[baseRates.length-1]["PLN"])
                    }
            }
            for (let j=0; j<exchange_rate.length; j++){ // получение курса обмена на каждый месяц
                let date=new Date (exchange_rate[j]["date"])
                if (date.getMonth() === settlementDate.getMonth() && date.getFullYear() === settlementDate.getFullYear()){
                    sales_rate_by_bank=parseFloat(exchange_rate[j][currency])*(1+spred/100)
                    monthResArray.average_monthly_exchange_rate=parseFloat(exchange_rate[j][currency]) //Średniomiesięczny kurs NBP
                    monthResArray.selling_rate_used_by=sales_rate_by_bank //Kurs sprzedaży stosowany przez
                    break
                }

                else{
                    sales_rate_by_bank=parseFloat(exchange_rate[exchange_rate.length-1][currency])*(1+spred/100)
                    monthResArray.average_monthly_exchange_rate=parseFloat(exchange_rate[exchange_rate.length-1][currency]) //Średniomiesięczny kurs NBP
                    monthResArray.selling_rate_used_by=sales_rate_by_bank //Kurs sprzedaży stosowany przez
                }
            }

            for (let i=0; i<inflation.length; i++){
                let date=new Date (inflation[i]["date"])
                if (date.getMonth() === settlementDate.getMonth() && date.getFullYear() === settlementDate.getFullYear()){
                    inflationsRateOnDate=parseFloat(inflation[i]["inflations_rate"])
                    break
                }
            else{
                    inflationsRateOnDate=parseFloat(inflation[inflation.length-1]["inflations_rate"])
                }
            }
            settlementDate.setMonth((settlementDate.getMonth()+1))//смещение даты для циклов


            let bankMargin = document.getElementById("bank_margin").value
            let rateAndBaseMargin=parseFloat(bankMargin)//Stawka bazowa + marża
            rateAndBaseMargin=parseFloat((rateAndBaseMargin+baseRateOnDate).toFixed(2))



            interestInstallment=(debt*rateAndBaseMargin/investment_period)/100

                let sum_capital_installment_currency=0
                let sum_capital_installment_currency_2=0
                let sum_capital_installment_PLN=0
                let sum_equal_instalments_total_installment_NBP=0
                let sum_degressive_instalments_capital_installment_currency_NBP=0
                let sum_hypothetical_installment_PLN=0
                let sum_degressive_hypotical_debt_PLN=0
                let sum_equal_pko_debt=0
                let sum_capital_installment=0
                let sum_degressive_pko_capital_installments=0
                let sum_degressive_pko_interest_installments=0
                let sum_remuneration_for_use_of_capital_calculated_by_the_bank_interest_installments=0
                let sum_accumulated_payments_of_the_borrower=0
                let sum_remuneration_calculated_by_the_bank_actual_payment=0


                resArray.forEach(function (item) {
                    if (item.capital_installment_in_currency !== undefined) {
                        sum_capital_installment_currency+=item.capital_installment_in_currency
                    }
                    if (item.capital_installment_in_currency_2 !== undefined) {
                        sum_capital_installment_currency_2+=item.capital_installment_in_currency_2
                    }
                    if (item.installments_without_indexation_capital_installment_in_PLN_2 !== undefined) {
                        sum_capital_installment_PLN+=item.installments_without_indexation_capital_installment_in_PLN_2
                    }
                    if (item.equal_instalments_total_installment_NBP !== undefined) {
                        sum_equal_instalments_total_installment_NBP+=item.equal_instalments_total_installment_NBP
                    }
                    if (item.degressive_instalments_capital_installment_currency_NBP !== undefined) {
                        sum_degressive_instalments_capital_installment_currency_NBP+=item.degressive_instalments_capital_installment_currency_NBP
                    }
                    if (item.equal_hypotical_capital_installment !== undefined) {
                        sum_hypothetical_installment_PLN+=item.equal_hypotical_capital_installment
                    }
                    if (item.degressive_hypotical_debt_PLN !== undefined) {
                        sum_degressive_hypotical_debt_PLN+=item.degressive_hypotical_capital_installments
                    }
                    if (item.equal_pko_debt !== undefined) {
                        sum_equal_pko_debt+=item.equal_pko_capital_installments+item.equal_pko_underpayment_overpayment
                    }
                    if (item.capital_installment !== undefined) {
                        sum_capital_installment+=item.capital_installment
                    }
                    if (item.degressive_pko_capital_installments !== undefined) {
                        sum_degressive_pko_capital_installments+=item.degressive_pko_capital_installments
                    }
                    if (item.degressive_pko_interest_installments !== undefined) {
                        sum_degressive_pko_interest_installments+=item.degressive_pko_interest_installments
                    }
                    if (item.remuneration_calculated_by_the_bank_interest_installments!== undefined) {
                        sum_remuneration_for_use_of_capital_calculated_by_the_bank_interest_installments+=item.remuneration_calculated_by_the_bank_interest_installments
                    }
                    if (item.remuneration_calculated_by_the_bank_actual_payment!== undefined) {
                        sum_remuneration_calculated_by_the_bank_actual_payment+=item.remuneration_calculated_by_the_bank_actual_payment
                    }
                });


                pmtInCurrency = (-pmt(((rateAndBaseMargin)/12)/100, pmtCounter, equivalent-sum_capital_installment_currency,0,0))//часть 2 PMT
                monthResArray.accrued_payment_in_foreign_currency=pmtInCurrency
                monthResArray.accrued_installment_in_PLN=pmtInCurrency * sales_rate_by_bank
                if(dateOfLoanRepayment<currentMonth){
                    monthResArray.accrued_payment_in_PLN=0
                    monthResArray.accrued_payment_in_currency=pmtInCurrency
                }
                else{
                    monthResArray.accrued_payment_in_PLN=pmtInCurrency * sales_rate_by_bank
                    monthResArray.accrued_payment_in_currency=0
                }
                currentMonth.setMonth(currentMonth.getMonth()+1)
                monthResArray.debt_in_PLN=amount-sum_capital_installment
                totalInstallment = (-pmt(((rateAndBaseMargin)/12)/100, pmtCounter,  monthResArray.debt_in_PLN,0,0))//часть 2 PMT
                monthResArray.PMT=totalInstallment
                monthResArray.difference=pmtInCurrency * sales_rate_by_bank-totalInstallment
                monthResArray.base_interest_rate=baseRateOnDate
                monthResArray.base_rate_and_bank_margin=rateAndBaseMargin
                monthResArray.interest_installment=(debt*(rateAndBaseMargin/100))/12
                monthResArray.capital_installment=totalInstallment-(debt*(rateAndBaseMargin/100))/12
                monthResArray.interest_installment_in_currency=(currency_debt*(rateAndBaseMargin/100))/12
                monthResArray.amount_of_currency_debt=equivalent-sum_capital_installment_currency
                monthResArray.capital_installment_in_currency=pmtInCurrency-(monthResArray.amount_of_currency_debt*(rateAndBaseMargin/100))/12

                //Raty należne wg banku
                monthResArray.interest_installment_in_currency_2=((equivalent-sum_capital_installment_currency_2)*(rateAndBaseMargin/100))/12
                monthResArray.interest_installment_debt=equivalent-sum_capital_installment_currency_2
                monthResArray.capital_installment_in_currency_2=(2>gracePeriodCaunter)?((investment_period-period)?(equivalent-sum_capital_installment_currency_2)/(investment_period-i):0):0
                monthResArray.total_installment_in_currency_2=monthResArray.capital_installment_in_currency_2+monthResArray.interest_installment_in_currency_2
                monthResArray.convert_total_installment_in_currency_2_in_PLN=monthResArray.total_installment_in_currency_2*sales_rate_by_bank

                //Raty bez klauzul indeksacyjnych
                monthResArray.installments_without_indexation_amount_of_PLN_debt=amount-sum_capital_installment_PLN;
                monthResArray.installments_without_indexation_interest_installment_in_PLN_2=(amount-sum_capital_installment_PLN)*((rateAndBaseMargin/100)/12)
                monthResArray.installments_without_indexation_capital_installment_in_PLN_2=(2>gracePeriodCaunter)?((investment_period-period)?(amount-sum_capital_installment_PLN)/(investment_period-i):0):0
                monthResArray.installments_without_indexation_total_installment_in_PLN_2=monthResArray.installments_without_indexation_capital_installment_in_PLN_2+monthResArray.installments_without_indexation_interest_installment_in_PLN_2
                monthResArray.installments_without_indexation_unjustified_excess=monthResArray.convert_total_installment_in_currency_2_in_PLN-monthResArray.installments_without_indexation_total_installment_in_PLN_2


                //------------------- Kredyt wg kursu średniego NBP-------------------------------------

                //raty równe
                monthResArray.equal_instalments_debtNBP=debtNBP-sum_equal_instalments_total_installment_NBP
                monthResArray.equal_instalments_interest_currency_NBP=monthResArray.equal_instalments_debtNBP*(rateAndBaseMargin/100)/12
                monthResArray.equal_instalments_capital_installment_currency_NBP=(2>gracePeriodCaunter)?(-pmt(((rateAndBaseMargin)/12)/100, pmtCounter, monthResArray.equal_instalments_debtNBP,0,0)):monthResArray.equal_instalments_interest_currency_NBP
                monthResArray.equal_instalments_total_installment_NBP=monthResArray.equal_instalments_capital_installment_currency_NBP-monthResArray.equal_instalments_interest_currency_NBP
                monthResArray.equal_instalments_capital_installment_currency_NBP_in_PLN=monthResArray.equal_instalments_capital_installment_currency_NBP*monthResArray.average_monthly_exchange_rate

                //raty malejące
                monthResArray.degressive_instalments_debtNBP=debtNBP-sum_degressive_instalments_capital_installment_currency_NBP
                monthResArray.degressive_instalments_interest_currency_NBP=monthResArray.equal_instalments_debtNBP*(rateAndBaseMargin/100)/12
                monthResArray.degressive_instalments_capital_installment_currency_NBP=(2>gracePeriodCaunter)?((investment_period-period)?(monthResArray.degressive_instalments_debtNBP)/(investment_period-i):0):0
                monthResArray.degressive_instalments_total_installment_NBP=(investment_period-period)?monthResArray.degressive_instalments_capital_installment_currency_NBP+monthResArray.degressive_instalments_interest_currency_NBP:0
                monthResArray.degressive_instalments_capital_installment_currency_NBP_in_PLN=monthResArray.degressive_instalments_total_installment_NBP*monthResArray.average_monthly_exchange_rate


                //-----------------Hipotetyczny kredyt złotowy------------------------
                monthResArray.wibor3M_PLN=wibor3M_PLN
                monthResArray.interest_rate_wibor3M_PLN=wibor3M_PLN+parseFloat(bankMargin)

                //raty równe
                monthResArray.equal_hypotical_debt_PLN=amount-sum_hypothetical_installment_PLN
                monthResArray.equal_hypotical_interest_installments=(monthResArray.equal_hypotical_debt_PLN*(monthResArray.interest_rate_wibor3M_PLN/100))/12
                monthResArray.equal_hypotical_total_installments=(-pmt(((monthResArray.interest_rate_wibor3M_PLN)/12)/100, pmtCounter, monthResArray.equal_hypotical_debt_PLN,0,0))
                monthResArray.equal_hypotical_capital_installment=monthResArray.equal_hypotical_total_installments-monthResArray.equal_hypotical_interest_installments

                //raty malejące
                monthResArray.degressive_hypotical_debt_PLN=amount-sum_degressive_hypotical_debt_PLN
                monthResArray.degressive_hypotical_interest_installments=(monthResArray.degressive_hypotical_debt_PLN*(monthResArray.interest_rate_wibor3M_PLN/100))/12
                monthResArray.degressive_hypotical_capital_installments=(investment_period-period)?(monthResArray.degressive_hypotical_debt_PLN)/(investment_period-i):0
                monthResArray.degressive_hypotical_total_installments=monthResArray.degressive_hypotical_capital_installments+monthResArray.degressive_hypotical_interest_installments

                //------------------------Propozycja PKO BP----------------------------
                //raty równe
                monthResArray.equal_pko_interest_rate=wibor3M_PLN+marginFromContract
                monthResArray.equal_pko_debt=amount-sum_equal_pko_debt
                monthResArray.equal_pko_interest_installments=(investment_period-period)?(monthResArray.equal_pko_debt*(monthResArray.equal_pko_interest_rate/100))/12:0
                monthResArray.equal_pko_total_installments=(-pmt(((monthResArray.equal_pko_interest_rate)/12)/100, pmtCounter, monthResArray.equal_pko_debt,0,0))
                monthResArray.equal_pko_capital_installments=(investment_period-period)?monthResArray.equal_pko_total_installments-monthResArray.equal_pko_interest_installments:0
                monthResArray.equal_pko_underpayment_overpayment=monthResArray.accrued_installment_in_PLN-monthResArray.equal_pko_total_installments

//-------------------------------------

                //---------------------raty malejące------------------------------------
                monthResArray.degressive_pko_debt=(amount-sum_degressive_pko_capital_installments)
                let f=1;
                    resArray.forEach(function (item){
                        if (f===resArray.length){
                            if (item.degressive_pko_underpayment_overpayment!==undefined){
                                monthResArray.degressive_pko_debt=(amount-sum_degressive_pko_capital_installments)+item.degressive_pko_underpayment_overpayment
                            }
                            if (item.accumulated_payments_of_the_borrower!==undefined){
                                sum_accumulated_payments_of_the_borrower=item.accumulated_payments_of_the_borrower
                            }
                        }
                        else{
                            f++
                        }
                    })
                monthResArray.degressive_pko_interest_installments=(monthResArray.degressive_pko_debt*(monthResArray.equal_pko_interest_rate/100))/12
                monthResArray.degressive_pko_capital_installments=(investment_period-period)?(monthResArray.degressive_pko_debt)/(investment_period-i):0
                monthResArray.degressive_pko_total_installments=(investment_period-period)?monthResArray.degressive_pko_capital_installments+monthResArray.degressive_pko_interest_installments:0
                monthResArray.degressive_pko_underpayment_overpayment=(investment_period-period)?monthResArray.degressive_pko_total_installments-monthResArray.accrued_installment_in_PLN:0


                //-----------------------Liczone przez bank wynagrodzenie za korzystanie z kapitału----------------------------

                monthResArray.remuneration_calculated_by_the_bank_debt=amount+sum_remuneration_for_use_of_capital_calculated_by_the_bank_interest_installments-sum_remuneration_calculated_by_the_bank_actual_payment
                monthResArray.remuneration_calculated_by_the_bank_interest_installments=(monthResArray.degressive_pko_debt*(monthResArray.equal_pko_interest_rate/100))/12
                monthResArray.remuneration_calculated_by_the_bank_actual_payment=monthResArray.accrued_installment_in_PLN
                monthResArray.remuneration_calculated_by_the_bank_underpayment_overpayment=monthResArray.remuneration_calculated_by_the_bank_actual_payment-monthResArray.remuneration_calculated_by_the_bank_interest_installments

                monthResArray.cumulative_inflation_rate_to_last_month=inflationsRateOnDate
                monthResArray.valorization_of_the_borrowers_repayments=(monthResArray.cumulative_inflation_rate_to_last_month*monthResArray.accrued_installment_in_PLN)/100
                monthResArray.accumulated_payments_of_the_borrower=sum_accumulated_payments_of_the_borrower+monthResArray.accrued_installment_in_PLN
                monthResArray.interest_for_a_given_month_at_the_rate_of_WIBOR_3M=((monthResArray.accumulated_payments_of_the_borrower*wibor3M_PLN)/100)/12


                currency_debt-=pmtInCurrency-(currency_debt*(rateAndBaseMargin/100))/12
                debt-=totalInstallment-(debt*(rateAndBaseMargin/100))/12

            resArray.push(monthResArray)
            monthResArray = {}

        }
    }
    let totalLoanPaymentsCollectedByTheBank=0
    let currentMonthlyLoanRepaymentAmountCurrency=0
    let currentMonthlyLoanRepaymentAmountPLN=0
    let installmentSystem=0
    let currentAmountOwed
    let currentSellingRate
    let totalLoanRepaymentsInCurrency=0
    let totalLoanRepaymentsInPLN=0
    let amountOfMonthlyInstallmentToRepayTheLoanWithoutIndexation=0
    let debtAmountWithoutIndexation=0
    let sumEqualPkoTotalInstallments=0
    let sumClaimRemuneration=0
    let sumInterestRateWIBOR3=0
    let sumDegressivePkoTotalInstallments
    let sumPMT=0
    let interestRateAfterMaturity=parseFloat(baseRates[baseRates.length-1]["PLN"])+marginFromContract
    let amountOwedAfterRepayment=0
    let amountOwedAfterRepaymentUnderpayment=0
    let sumValorizationOfTheBorrowersRepayments=0
    let f=1;
    let date=new Date()
    let dateEnd=new Date(dateStart)
    dateEnd.setMonth(dateStart.getMonth()+investment_period)
    let installmentSystemsSelect=document.getElementById("installment_system")
    installmentSystem=parseInt(installmentSystemsSelect.options[installmentSystemsSelect.selectedIndex].value)

    resArray.forEach(function (item){

        let datePay=new Date (item.date)
        if (date.getMonth() === datePay.getMonth() && date.getFullYear() === datePay.getFullYear()){
            currentAmountOwed=(!installmentSystem)?item.equal_instalments_debtNBP:item.degressive_instalments_debtNBP
        }

        if (item.accrued_installment_in_PLN){
            totalLoanPaymentsCollectedByTheBank+=item.accrued_installment_in_PLN
        }
        if(item.accrued_payment_in_currency){
            totalLoanRepaymentsInCurrency+=item.accrued_payment_in_currency
        }
        if(item.accrued_payment_in_PLN){
            totalLoanRepaymentsInPLN+=item.accrued_payment_in_PLN
        }
        if (f===resArray.length) {
            currentMonthlyLoanRepaymentAmountPLN = item.accrued_installment_in_PLN
            currentMonthlyLoanRepaymentAmountCurrency = item.accrued_payment_in_foreign_currency
            currentSellingRate = item.selling_rate_used_by
            if(!installmentSystem){
                amountOfMonthlyInstallmentToRepayTheLoanWithoutIndexation=item.capital_installment
                debtAmountWithoutIndexation=item.debt_in_PLN
            }
            else{
                amountOfMonthlyInstallmentToRepayTheLoanWithoutIndexation=item.installments_without_indexation_total_installment_in_PLN_2
                debtAmountWithoutIndexation=item.installments_without_indexation_amount_of_PLN_debt
            }
        }
        else {
            f++
        }
        if(!installmentSystem){
            if (item.PMT){
                sumPMT+=item.PMT
            }
            if (item.equal_pko_capital_installments){
                amountOwedAfterRepayment+=item.equal_pko_capital_installments
            }
            if (item.equal_pko_underpayment_overpayment)
                amountOwedAfterRepaymentUnderpayment+=-(item.equal_pko_underpayment_overpayment)
        }
        else if (item.PMT){
            sumPMT+=item.installments_without_indexation_total_installment_in_PLN_2
        }
        else if (item.equal_pko_debt){
            amountOwedAfterRepayment+=item.degressive_pko_debt
        }
        if(item.equal_pko_total_installments){
            sumEqualPkoTotalInstallments+=item.equal_pko_total_installments
        }
        if (item.degressive_pko_total_installments){
            sumDegressivePkoTotalInstallments+=item.degressive_pko_total_installments
        }
        if (item.remuneration_calculated_by_the_bank_interest_installments){
            sumClaimRemuneration+=item.remuneration_calculated_by_the_bank_interest_installments
        }
        if (item.interest_for_a_given_month_at_the_rate_of_WIBOR_3M){
            sumInterestRateWIBOR3+=item.interest_for_a_given_month_at_the_rate_of_WIBOR_3M
        }
        if (item.valorization_of_the_borrowers_repayments){
            sumValorizationOfTheBorrowersRepayments+=item.valorization_of_the_borrowers_repayments
        }

    })

    let cells=document.querySelectorAll("td")

    for (const cell of cells) {

        //Таблица 1
        if ((date.getMonth() <= dateEnd.getMonth() && date.getFullYear() <= dateEnd.getFullYear())){ //если кредит еще не выплачен и есть текущие платежи
            if (cell.dataset.content==='current_monthly_loan_repayment_amount_currency') {
                cell.textContent = currentMonthlyLoanRepaymentAmountCurrency.toFixed(2)
            }
            if (cell.dataset.content==='current_monthly_loan_repayment_amount_PLN') {
                cell.textContent = currentMonthlyLoanRepaymentAmountPLN.toFixed(2)
            }
            if (cell.dataset.content==='current_amount_owed') {
                cell.textContent = currentAmountOwed.toFixed(2)
            }
            if (cell.dataset.content==='current_amount_owed_PLN') {
                cell.textContent = (currentAmountOwed*currentSellingRate).toFixed(2)
            }
        }

        else{
            if (cell.dataset.content==='current_monthly_loan_repayment_amount_currency') {
                cell.textContent = '0.00'
            }
            if (cell.dataset.content==='current_monthly_loan_repayment_amount_PLN') {
                cell.textContent = '0.00'
            }
            if (cell.dataset.content==='current_amount_owed') {
                cell.textContent = '0.00'
            }
            if (cell.dataset.content==='current_amount_owed_PLN') {
                cell.textContent = '0.00'
            }
        }

        if (!installmentSystem){
            if (cell.dataset.content==='total_loan_payments_collected_by_the_bank') {
                cell.textContent = totalLoanPaymentsCollectedByTheBank.toFixed(2)
            }

        }

        //Таблица 2
        if (cell.dataset.content==='credit_amount') {
            cell.textContent = amount.toFixed(2)
        }
        if (cell.dataset.content==='total_loan_repayments_in_PLN') {
            cell.textContent = totalLoanRepaymentsInPLN.toFixed(2)
        }
        if (cell.dataset.content==='total_loan_repayments_in_currency') {
            cell.textContent = totalLoanRepaymentsInCurrency.toFixed(2)
        }
        if (cell.dataset.content==='present_value_of_amounts_paid_in_currency') {
            cell.textContent = (totalLoanRepaymentsInCurrency*exchange_rate[exchange_rate.length-1][currency]).toFixed(2)
        }
        if (cell.dataset.content==='total_amount_of_the_borrowers_payments') {
            cell.textContent = (totalLoanRepaymentsInPLN+totalLoanRepaymentsInCurrency*exchange_rate[exchange_rate.length-1][currency]).toFixed(2)
        }
        if (cell.dataset.content==='to_be_returned_to_the_bank') {
            //пока пусто
        }
        if (cell.dataset.content==='must_be_returned_to_the_borrower') {
            cell.textContent = ((totalLoanRepaymentsInPLN+totalLoanRepaymentsInCurrency*exchange_rate[exchange_rate.length-1][currency])>amount)?((totalLoanRepaymentsInPLN+totalLoanRepaymentsInCurrency*exchange_rate[exchange_rate.length-1][currency])-amount).toFixed(2):0
        }
        if (cell.dataset.content==='overall_benefit_to_the_borrower') {
            cell.textContent = (((!isNaN(currentAmountOwed))?parseFloat(currentAmountOwed):parseInt('0'))+((totalLoanRepaymentsInPLN+totalLoanRepaymentsInCurrency*exchange_rate[exchange_rate.length-1][currency])-amount)).toFixed(2)
        }

        //Таблица 3
        if ((date.getMonth() <= dateEnd.getMonth() && date.getFullYear() <= dateEnd.getFullYear())) {
            if (cell.dataset.content==='amount_of_monthly_installment_to_repay_the_loan_without_indexation') {
                cell.textContent = amountOfMonthlyInstallmentToRepayTheLoanWithoutIndexation.toFixed(2)
            }
            if (cell.dataset.content==='debt_amount_without_indexation') {
                cell.textContent = debtAmountWithoutIndexation.toFixed(2)
            }
        }
        if (cell.dataset.content==='amount_of_loan_installments_without_indexation') {
            cell.textContent = sumPMT.toFixed(2)
        }
        if (cell.dataset.content==='total_loan_repayments') {
            cell.textContent = totalLoanPaymentsCollectedByTheBank.toFixed(2)
        }
        if (cell.dataset.content==='must_be_returned_to_the_borrower_table_3') {
            cell.textContent = (totalLoanPaymentsCollectedByTheBank-sumPMT).toFixed(2)
        }
        if (cell.dataset.content==='overall_benefit_to_the_borrower_table_3') {
            cell.textContent = ((totalLoanPaymentsCollectedByTheBank-sumPMT)).toFixed(2)
        }


        //Таблица 4
        if (cell.dataset.content==='average_margin') {
            cell.textContent = marginFromContract.toFixed(2)
        }
        if (cell.dataset.content==='amount_of_monthly_loan_payment_after_repayment') {


        }
        if (cell.dataset.content==='interest_rate_after_maturity') {
            cell.textContent = interestRateAfterMaturity.toFixed(2)
        }
        if (cell.dataset.content==='amount_owed_after_repayment') {
            cell.textContent = (amount-(amountOwedAfterRepayment-amountOwedAfterRepaymentUnderpayment)).toFixed(2)
        }
        if (cell.dataset.content==='total_loan_payments_due_to_the_bank_after_conversion') {
            cell.textContent = ((!installmentSystem)?sumEqualPkoTotalInstallments:sumDegressivePkoTotalInstallments).toFixed(2)
        }
        if (cell.dataset.content==='total_contributions_and_outstanding_debt') {
            cell.textContent = (((!installmentSystem)?sumEqualPkoTotalInstallments:sumDegressivePkoTotalInstallments)+(amount-amountOwedAfterRepayment)).toFixed(2)
        }
        if (cell.dataset.content==='overall_benefit_to_the_borrower_table_4') {
            cell.textContent = (!isNaN(currentAmountOwed)?(currentAmountOwed*currentSellingRate-(amount-amountOwedAfterRepayment)):-(amount-(amountOwedAfterRepayment-amountOwedAfterRepaymentUnderpayment)).toFixed(2))
        }


        //Таблица 5
        if (cell.dataset.content==='current_amount_of_debt_PLN') {
            cell.textContent = !isNaN(currentAmountOwed)?currentAmountOwed.toFixed(2):"0.00"
        }
        if (cell.dataset.content==='total_loan_repayments_PLN') {
            cell.textContent = (totalLoanRepaymentsInCurrency*exchange_rate[exchange_rate.length-1][currency]).toFixed(2)
        }
        if (cell.dataset.content==='a_claim_for_remuneration') {
            cell.textContent = sumClaimRemuneration.toFixed(2)
        }
        if (cell.dataset.content==='total_bank_claims_PLN') {
            cell.textContent = (amount+sumClaimRemuneration).toFixed(2)
        }
        if (cell.dataset.content==='amount_of_the_banks_claims') {
            cell.textContent = ((amount+sumClaimRemuneration)-totalLoanRepaymentsInCurrency*exchange_rate[exchange_rate.length-1][currency]).toFixed(2)
        }


        //Таблица 6
        if (cell.dataset.content==='aggregate_amount_of_the_borrowers_payments') {
            cell.textContent = totalLoanPaymentsCollectedByTheBank.toFixed(2)
        }
        if (cell.dataset.content==='interest_rate_on_amounts_paid_WIBOR_3M_rate') {
            cell.textContent = sumInterestRateWIBOR3.toFixed(2)
        }
        if (cell.dataset.content==='amount_of_borrowers_claims') {
            cell.textContent = (sumInterestRateWIBOR3+totalLoanPaymentsCollectedByTheBank).toFixed(2)
        }

        //Таблица 7
        if (cell.dataset.content==='credit_amount_nominal') {
            cell.textContent = amount.toFixed(2)
        }
        for (let i=0; i<inflation.length; i++){
            console.log (inflation[i])
            let date=new Date (inflation[i]["date"])
            if (date.getMonth() === dateStart.getMonth() && date.getFullYear() === dateStart.getFullYear()){
                inflationsRateOnDate=parseFloat(inflation[i]["inflation"])
                break
            }
            else{
                inflationsRateOnDate=parseFloat(inflation[inflation.length-1]["inflation"])
            }
        }
        console.log (dateStart)
        console.log (inflationsRateOnDate)
        if (cell.dataset.content==='credit_amount_additional') {
            cell.textContent = ((amount*inflationsRateOnDate)/100).toFixed(2)
        }
        if (cell.dataset.content==='credit_amount_total') {
            cell.textContent = ((amount*inflationsRateOnDate)/100+amount).toFixed(2)
        }


        if (cell.dataset.content==='total_paid_by_the_bank_PLN_nominal') {
            cell.textContent = amount.toFixed(2)
        }
        if (cell.dataset.content==='total_paid_by_the_bank_PLN_additional') {
            cell.textContent = ((amount*inflationsRateOnDate)/100).toFixed(2)
        }
        if (cell.dataset.content==='total_paid_by_the_bank_PLN_total') {
            cell.textContent = ((amount*inflationsRateOnDate)/100+amount).toFixed(2)
        }
        if (cell.dataset.content==='payments_to_the_borrower_including_prepayments_PLN_nominal') {
            cell.textContent = totalLoanPaymentsCollectedByTheBank.toFixed(2)
        }
        if (cell.dataset.content==='payments_to_the_borrower_including_prepayments_PLN_additional') {
            cell.textContent = sumValorizationOfTheBorrowersRepayments.toFixed(2)
        }
        if (cell.dataset.content==='payments_to_the_borrower_including_prepayments_PLN_total') {
            cell.textContent = (sumValorizationOfTheBorrowersRepayments+totalLoanRepaymentsInPLN).toFixed(2)
        }



        if (cell.dataset.content==='difference_PLN_nominal') {
            cell.textContent = (totalLoanPaymentsCollectedByTheBank-amount).toFixed(2)
        }
        if (cell.dataset.content==='difference_PLN_additional') {
            cell.textContent = (sumValorizationOfTheBorrowersRepayments-(amount*inflationsRateOnDate)/100).toFixed(2)
        }
        if (cell.dataset.content==='difference_PLN_total') {
            cell.textContent = ((sumValorizationOfTheBorrowersRepayments+totalLoanPaymentsCollectedByTheBank)-((amount*inflationsRateOnDate)/100+amount)).toFixed(2)
        }

    }







        let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "/calculation_results", true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken); // Подставьте свой CSRF-токен
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Успешный ответ
                    console.log(xhr.responseText);
                } else {
                    // Ошибка
                    console.error("Ошибка:", xhr.statusText);
                }
            }
        };
        let userData = {
            name: 'John',
            surname: 'Smith'
        };
        xhr.send(JSON.stringify(resArray));
}

