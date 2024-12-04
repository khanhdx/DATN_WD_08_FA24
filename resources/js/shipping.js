import './bootstrap';
const tokenGHN = import.meta.env.VITE_TOKEN_GHN;
const shopId = import.meta.env.VITE_SHOP_ID;

axios.defaults.headers.common['Token'] = tokenGHN;
axios.defaults.headers.common['shopId'] = shopId;

const province = document.getElementById('province');
const district = document.getElementById('district');
const wardStreet = document.getElementById('ward_street');
const shippingFee = document.getElementById('shipping_fee');
const inputShipFee = document.getElementById('input_ship_fee');
const totalAmount = document.getElementById('totalAmount');

const firstDistrict = district.firstElementChild;
const firstWardStreet = wardStreet.firstElementChild;

let weight = 100;
let districtId;

axios.get('https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/province')
    .then((response) => {
        const dataProvince = response.data.data;

        dataProvince.forEach(item => {
            const optionElement = document.createElement('option');

            optionElement.dataset.id = item.ProvinceID;
            optionElement.value = item.ProvinceName;
            optionElement.textContent = item.ProvinceName;
            province.appendChild(optionElement);
        });
    })
    .catch((errors) => {
        console.log(errors);
    });

province.addEventListener('change', function (e) {
    const selectedOption = province.options[province.selectedIndex];

    const provinceId = selectedOption.dataset.id;

    axios.get(`https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/district?province_id=${provinceId}`)
        .then((response) => {
            const dataDistrict = response.data.data;

            while (district.lastElementChild !== firstDistrict) {
                district.removeChild(district.lastElementChild);
            }

            while (wardStreet.lastElementChild !== firstWardStreet) {
                wardStreet.removeChild(wardStreet.lastElementChild);
            }

            dataDistrict.forEach(item => {
                const optionElement = document.createElement('option');

                optionElement.dataset.id = item.DistrictID;
                optionElement.value = item.DistrictName;
                optionElement.textContent = item.DistrictName;
                district.appendChild(optionElement);
            });
        }).catch((errors) => {
            console.log(errors);
        });
});

district.addEventListener('change', function (e) {
    const selectedOption = district.options[district.selectedIndex];
    districtId = selectedOption.dataset.id;

    axios.get(`https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/ward?district_id=${districtId}`)
        .then((response) => {
            const dataDistrict = response.data.data;

            while (wardStreet.lastElementChild !== firstWardStreet) {
                wardStreet.removeChild(wardStreet.lastElementChild);
            }

            dataDistrict.forEach(item => {
                const optionElement = document.createElement('option');

                optionElement.dataset.id = item.WardCode;
                optionElement.value = item.WardName;
                optionElement.textContent = item.WardName;
                wardStreet.appendChild(optionElement);
            });
        }).catch((errors) => {
            console.log(errors);
        });
});

wardStreet.addEventListener('change', function (e) {
    const selectedOption = wardStreet.options[wardStreet.selectedIndex];
    let wardStreetId = selectedOption.dataset.id;

    axios.request(
        {
            method: 'post',
            url: 'https://dev-online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee',
            data: {
                "service_type_id": 2,
                "to_district_id": Number(districtId),
                "to_ward_code": wardStreetId,
                "weight": quantity * weight
            }
        })
        .then((response) => {
            const data = response.data.data;
            let sum = 0;

            shippingFee.classList.add("price");
            inputShipFee.value = data.total;
            shippingFee.textContent = data.total.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });

            sum = Number(totalAmount.dataset.total) + Number(data.total);
            totalAmount.innerHTML = sum.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' })
        }).catch((errors) => {
            console.log(errors);
        });
});