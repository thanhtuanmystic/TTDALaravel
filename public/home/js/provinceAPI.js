const host = "https://provinces.open-api.vn/api/";
var callAPI = (api) => {
    return axios.get(api).then((response) => {
        renderData(response.data, "province");
    });
};
callAPI("https://provinces.open-api.vn/api/?depth=1");
var callApiDistrict = (api) => {
    return axios.get(api).then((response) => {
        renderData(response.data.districts, "district");
    });
};
var callApiWard = (api) => {
    return axios.get(api).then((response) => {
        renderData(response.data.wards, "ward");
    });
};

var renderData = (array, select) => {
    let row = ' <option disable value="">chọn</option>';
    array.forEach((element) => {
        row += `<option value="${element.code}">${element.name}</option>`;
    });
    document.querySelector("#" + select).innerHTML = row;
};

$("#province").change(() => {
    $("#province_value").val($("#province option:selected").text());
    callApiDistrict(host + "p/" + $("#province").val() + "?depth=2");
});
$("#district").change(() => {
    $("#district_value").val($("#district option:selected").text());

    callApiWard(host + "d/" + $("#district").val() + "?depth=2");
});
$("#ward").change(() => {
    $("#ward_value").val($("#ward option:selected").text());
});
