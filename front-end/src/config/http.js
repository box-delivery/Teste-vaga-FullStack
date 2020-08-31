import Cookies from "@/utils/Cookies";

const Http = {
  header() {
    const token = Cookies.read("token");
    const headers = {
      Accept: 'application/json',
      'Content-Type': 'application/json',
      Authorization: `Bearer` + token,
    };

    return headers;
  },
};

export default Http;
