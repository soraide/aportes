const getIdLinkYoutube = (link) => {
    let regex_link_url = /=/;
    let regex_link_compartir = /youtu.be/;

    if (regex_link_url.test(link)) {
        return link.split("=").pop();
    } else if (regex_link_compartir.test(link)) {
        return link.split("/").pop();
    }
}

let link_url = "https://www.youtube.com/watch?v=br4Z-HZtIQQ";
let link_compartir = "https://youtu.be/br4Z-HZtIQQ";
console.log(getIdLinkYoutube(link_compartir));